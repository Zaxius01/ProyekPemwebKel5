<?php

function arunikaNormalizeBookingData(array $source)
{
    $booking = [];

    $roomId = isset($source['room_id']) && (is_string($source['room_id']) || is_int($source['room_id']))
        ? (string) $source['room_id']
        : '';
    if ($roomId !== '' && ctype_digit($roomId) && (int) $roomId > 0) {
        $booking['room_id'] = (int) $roomId;
    }

    foreach (['check_in', 'check_out'] as $dateField) {
        if (isset($source[$dateField]) && is_string($source[$dateField]) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $source[$dateField])) {
            $dateParts = explode('-', $source[$dateField]);
            if (checkdate((int) $dateParts[1], (int) $dateParts[2], (int) $dateParts[0])) {
                $booking[$dateField] = $source[$dateField];
            }
        }
    }

    if (
        isset($booking['check_in'], $booking['check_out'])
        && $booking['check_out'] <= $booking['check_in']
    ) {
        unset($booking['check_in'], $booking['check_out']);
    }

    $guests = isset($source['guests']) && (is_string($source['guests']) || is_int($source['guests']))
        ? (string) $source['guests']
        : '';
    if ($guests !== '' && ctype_digit($guests) && (int) $guests >= 1 && (int) $guests <= 5) {
        $booking['guests'] = (int) $guests;
    }

    return $booking;
}

function arunikaBuildBookingUrl(array $source)
{
    $booking = arunikaNormalizeBookingData($source);

    return 'booking.php' . ($booking ? '?' . http_build_query($booking, '', '&', PHP_QUERY_RFC3986) : '');
}

function arunikaSafeBookingRedirect($candidate)
{
    if (!is_string($candidate) || $candidate === '' || strlen($candidate) > 2048) {
        return null;
    }

    $parts = parse_url($candidate);
    if (
        $parts === false
        || !isset($parts['path'])
        || $parts['path'] !== 'booking.php'
        || isset($parts['scheme'])
        || isset($parts['host'])
        || isset($parts['user'])
        || isset($parts['pass'])
        || isset($parts['port'])
        || isset($parts['fragment'])
    ) {
        return null;
    }

    $query = [];
    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
    }

    foreach (array_keys($query) as $key) {
        if (!in_array($key, ['room_id', 'check_in', 'check_out', 'guests'], true)) {
            return null;
        }
    }

    return arunikaBuildBookingUrl($query);
}

function arunikaResolveBookingRedirect($candidate)
{
    $redirect = arunikaSafeBookingRedirect($candidate);
    if ($redirect !== null) {
        return $redirect;
    }

    if (isset($_SESSION['pending_booking']) && is_array($_SESSION['pending_booking'])) {
        return arunikaBuildBookingUrl($_SESSION['pending_booking']);
    }

    return '';
}
