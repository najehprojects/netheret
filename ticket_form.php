<?php
$validPriorities = ["low", "medium", "high", "urgent"];
$errors = [];

$title = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$priority = $_POST["priority"] ?? "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

if (empty($title) || strlen($title) > 100) {
    $errors[] = "Title must be 1 − 100 characters.";
}


// TODO 5: if $description is empty or longer than 500 characters, add a message
if (empty($description) || strlen($description) > 500) {
    $errors[] = "Description must be 1 − 500 characters.";
}

if (!in_array($priority, $validPriorities, true)) {
    $errors[] = "Priority must be one of: " . implode(", ", $validPriorities) . ".";
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

<form id="ticket-form" method="post" action="ticket_form.php"
novalidate>

    <label for="title">Title</label>
    <input type="text" id="title" name="title" maxlength="100" value="<?= htmlspecialchars($title) ?>">
    <span id="title-error" class="error" role="alert"></span>

    <label for="description">Description</label>

        <textarea id="description" name="description" rows="5"
            maxlength="500"><?= htmlspecialchars($description)?>
        </textarea>

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
const form = document.getElementById("ticket-form");

form.addEventListener("submit", function (event) {
    let valid = true;

    const title = document.getElementById("title").value.trim();
    const description = document.getElementById("description").value.trim();

    const priority = document.getElementById("priority").value;
    
    document.getElementById("title-error").textContent = "";
    document.getElementById("description-error").textContent = "";
    document.getElementById("priority-error").textContent = "";

    if title === "") {
        document.getElementById("title-error").textContent = "Please enter a title.";
        valid = false;
    }

    if description === "") {
        document.getElementById("description-error").textContent = "Please enter a description.";
        valid = false;
    }

    if priority === "") {
        document.getElementById("priority-error").textContent = "Please choose a priority.";
        valid = false;
    }

if (!valid) {
    event.preventDefault();
}
});
</script>
</body>
</html>