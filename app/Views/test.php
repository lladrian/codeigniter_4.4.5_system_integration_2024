<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Section</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="comments">
        <h2>Comments</h2>
        <div class="comment">
            <div class="comment-header">
                <span class="comment-author">John Doe</span>
                <span class="comment-date">February 23, 2024</span>
            </div>
            <p class="comment-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec ex tellus. Donec nec finibus velit.</p>
        </div>
        <!-- More comments can go here -->
    </div>
    <div class="comment-form">
        <h2>Leave a Comment</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="author">Name:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
