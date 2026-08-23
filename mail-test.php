<?php
// ─────────────────────────────────────────────
// TEMPORARY TEST FILE — delete this after testing!
// Visit this file directly in your browser to test if mail() works.
// ─────────────────────────────────────────────

$to_email = "mitrasrijan646@gmail.com"; // change if needed

error_reporting(E_ALL);
ini_set('display_errors', 1); // show errors on THIS page, since it's just for us to debug

$subject = "Mail Test — " . date('Y-m-d H:i:s');
$body    = "This is a test email to confirm PHP mail() works on this server.\n\nSent at: " . date('Y-m-d H:i:s');
$headers = "From: no-reply@" . ($_SERVER['HTTP_HOST'] ?? 'example.com') . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

echo "<h2>PHP mail() Test</h2>";
echo "<p>Server: " . htmlspecialchars($_SERVER['HTTP_HOST'] ?? 'unknown') . "</p>";
echo "<p>Attempting to send to: " . htmlspecialchars($to_email) . "</p><hr>";

$sent = mail($to_email, $subject, $body, $headers);
$last_error = error_get_last();

if ($sent) {
    echo "<p style='color:green;font-weight:bold;'>✅ mail() returned TRUE — a send was attempted.</p>";
    echo "<p>This does NOT guarantee delivery — check your inbox (and spam folder) in the next few minutes.</p>";
    echo "<p>If nothing arrives within 10 minutes, your host is likely accepting the mail() call but silently dropping or filtering the message (common with shared hosting lacking SPF/DKIM setup).</p>";
} else {
    echo "<p style='color:red;font-weight:bold;'>❌ mail() returned FALSE — sending failed outright.</p>";
    echo "<p>Error detail: " . htmlspecialchars($last_error['message'] ?? 'No specific PHP error captured.') . "</p>";
    echo "<p>This usually means mail() is disabled or not configured on your hosting plan. Contact your host's support, or switch to SMTP-based sending (e.g. PHPMailer + Gmail/SendGrid/Mailgun SMTP credentials).</p>";
}

echo "<hr><p style='color:#888;font-size:13px;'>Remember to delete this file once you're done testing — don't leave it publicly accessible.</p>";
