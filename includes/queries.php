<?php
function getEngineerSchedule(PDO $pdo, int $engineerId): array
{
    $stmt = $pdo->prepare(
        "SELECT j.id, j.scheduled_start, j.site_postcode, j.job_brief, t.title AS ticket_title
         FROM jobs j
         JOIN tickets t ON t.id = j.ticket_id
         WHERE j.engineer_id = ? AND j.status = 'scheduled'
         ORDER BY j.scheduled_start"
    );

    // TODO 1: execute with [$engineerId] and return all the rows
}

function searchKnowledge(PDO $pdo, string $term): array
{
    $like = '%' . $term . '%';
    // TODO 2: prepare "SELECT id, title, category FROM knowledge_articles
    //                  WHERE title LIKE ? OR body LIKE ? ORDER BY title"
    //         execute with [$like, $like] and return all the rows
}

function createJob(PDO $pdo, int $ticketId, int $engineerId, string $start, string $postcode, string $brief): int
{
    // TODO 3: INSERT INTO jobs (ticket_id, engineer_id, scheduled_start, site_postcode, job_brief)
    //         VALUES (?, ?, ?, ?, ?)   then return (int)$pdo->lastInsertId()
}

function updateJobStatus(PDO $pdo, int $jobId, string $status): bool
{
    $allowed = ['scheduled', 'in_progress', 'completed', 'cancelled'];
    // TODO 4: if $status is not in $allowed return false;
    //         otherwise UPDATE jobs SET status = ? WHERE id = ? and return true
}

function deleteJob(PDO $pdo, int $jobId): bool
{
    // TODO 5: DELETE FROM jobs WHERE id = ?   return true if a row was deleted (rowCount() > 0)
}