<?php
/** Loose check that a string looks like a UK postcode. */
function isValidPostcode(string $postcode): bool
{
    return (bool)preg_match('/^[A-Z]{1,2}\d[A-Z\d]?\s?\d[A-Z]{2}$/i', trim($postcode));
}