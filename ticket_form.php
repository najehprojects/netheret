<?php
$validPriorities = ["low", "medium", "high", "urgent"];
$errors = [];

$title = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$priority = $_POST["priority"] ?? "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($title === "" || mb_strlen($title) > 100){
        $errors[] = "Title must be between 1 and 100 characters.";
    }
    if ($description === "" || mb_strlen($description) > 500) {
        $errors[] = "Description must be between 1 and 500 characters.";
    }
    if (!in_array($priority, $validPriorities, true)) {
        $errors[] = "Please choose a valid priority.";
    }
    if (empty($errors)) {
        // Saving to the database comes in the CRUD task
        http_response_code(201);
        echo "Ticket logged";
        exit;
    }
    http_response_code(400);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log a Ticket</title>
    </head>
    <body>
        <?php if (!empty($errors)): ?>
            <ul class="error" role="alert">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <form id="ticket-form" method="post" action="ticket_form.php" novalidate>

        <label for="title">Title</label>
        <input type="text" id="title" name="title" maxlength="100" value="<?= htmlspecialchars($title) ?>">
        <span id="title-error" class="error" role="alert"></span>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5" maxlength="500"><?= htmlspecialchars($description) ?></textarea>
        <span id="description-error" class="error" role="alert"></span>

        <label for="priority">Priority</label>
        <select id="priority" name="priority">
            <option value="">-- Choose a priority --</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
            <option value="urgent">Urgent</option>
        </select>
        <span id="priority-error" class="error" role="alert"></span>

        <button type="submit">Log ticket</button>
    </form>

    <script>
        const form = document.getElementById("tickte-form");

        form.addEventListener("submit", function (event){
            let valid = true;

            const title = document.getElementById("title").value.trim();
            const description = document.getElementbyId("description").value.trim();
            const priority = document.getElementById("priority").value;

            document.getElementById("title-error").textContent = "";
            document.getElementbyId("description-error").textContent = "";
            document.getElementById("priority-error").textContent = "";

            if (title === "") {
                document.getElementById("title-error").textContent = "Please enter a title";
                valid = false;
            }
            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
    </body>
</html>