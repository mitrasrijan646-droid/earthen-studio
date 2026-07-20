<?php
header('Content-Type: application/json');

// ─────────────────────────────────────────────
// Change this to the email address that should receive enquiries:
$to_email = "mitrasrijan646@gmail.com";
// ─────────────────────────────────────────────

$name    = trim($_POST['fname']   ?? '');
$phone   = trim($_POST['phone']   ?? '');
$email   = trim($_POST['email']   ?? '');
$project = trim($_POST['project'] ?? '');
$message = trim($_POST['message'] ?? '');

// basic check so it doesn't email you an empty form
if ($name === '' || $email === '' || $message === '') {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
    exit;
}

$subject = "New Project Enquiry — $project ($name)";

$body  = "Name: $name\n";
$body .= "Phone: $phone\n";
$body .= "Email: $email\n";
$body .= "Project Type: $project\n";
$body .= "Message:\n$message\n";

$headers = "From: $email\r\nReply-To: $email";

error_reporting(E_ALL);
ini_set('display_errors', 0); // don't show raw PHP errors on page, we'll capture it below instead

$sent = @mail($to_email, $subject, $body, $headers);
$last_error = error_get_last();

if ($sent) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Something went wrong. Please email us directly.',
        'debug' => $last_error['message'] ?? 'mail() returned false with no PHP error — your host likely has mail() disabled or unconfigured.'
    ]);
}
?>