<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/db.php';
requireRole('manager');

$open   = (int)$pdo->query("SELECT COUNT(*) FROM tickets WHERE status = 'open'")->fetchColumn();
$urgent = (int)$pdo->query("SELECT COUNT(*) FROM tickets WHERE priority = 'urgent' AND status <> 'resolved'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manager dashboard</title>
  <link rel="stylesheet" href="css/ux.css">
</head>
<body>
<main>
  <h1>Manager dashboard</h1>

  <section class="kpis" aria-label="Key figures">
    <div class="kpi"><span class="kpi-value"><?= $open ?></span> open tickets</div>
    <div class="kpi"><span class="kpi-value"><?= $urgent ?></span> urgent, unresolved</div>
  </section>

  <section>
    <h2>Tickets by status</h2>
    <canvas id="statusChart" role="img" aria-label="Bar chart of the number of tickets by status"></canvas>

    <table id="statusTable">
      <caption>Tickets by status (same data as the chart)</caption>
      <thead><tr><th scope="col">Status</th><th scope="col">Tickets</th></tr></thead>
      <tbody></tbody>
    </table>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
<script>
fetch('api_ticket_stats.php?by=status')
  .then(response => response.json())
  .then(rows => {
    
    $labels rows.map(row => row.label);
    $values rows.map(row => Number(row.total));

    new Chart(document.getElementById('statusChart'), {
      type: 'bar',
      data: { labels: labels, datasets: [{ label: 'Tickets', data: values, backgroundColor: '#0072B2' }] },
      options: {
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, ticks: { precision: 0 }, title: { display: true, text: 'Number of tickets' } },
          x: { title: { display: true, text: 'Status' } }
        }
      }
    });

    // TODO 3: fill the table body with one row per status, so the data is also available as text
  })
  .catch(error => console.error('Could not load stats:', error));
</script>
</body>
</html>