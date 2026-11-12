-- INSERT INTO knowledge_articles (title, category, body) VALUES
-- ('Printer shows offline', 'Hardware', '1. Check the printer is on and connected. 2. Restart the print spooler. 3. Re-add the printer if it is still offline.'),
-- ('User cannot log in', 'Accounts', '1. Check Caps Lock. 2. Reset the password. 3. Check the account is not locked.'),
-- ('Wi-Fi connected but no internet', 'Network', '1. Restart the router. 2. Check other devices. 3. Run ipconfig /renew.');


INSERT INTO jobs (ticket_id, engineer_id, scheduled_start, site_postcode, job_brief) VALUES
(1, 1, '2026-11-20 09:00:00', 'BR8 7RE', 'Replace faulty network switch in comms cupboard');