<?php
/** Loose check that a string looks like a UK postcode. */
function isValidPostcode(string $postcode): bool
{
    return (bool)preg_match('/^[A-Z]{1,2}\d[A-Z\d]?\s?\d[A-Z]{2}$/i', trim($postcode));
}

/** Return a list of error messages for ticket data (empty list = valid). */
function validateTicketInput(array $in): array
{
    $errors = [];
    $priorities = ['low', 'medium', 'high', 'urgent'];
    $title = trim((string)($in['title'] ?? ''));
    $description = trim((string)($in['description'] ?? ''));
    if ($title === '' || mb_strlen($title) > 100)             { $errors[] = 'Title must be 1-100 characters.'; }
    if ($description === '' || mb_strlen($description) > 500) { $errors[] = 'Description must be 1-500 characters.'; }
    if (!in_array($in['priority'] ?? '', $priorities, true))  { $errors[] = 'Priority must be low, medium, high or urgent.'; }
    return $errors;
}