CREATE TABLE IF NOT EXISTS knowledge_articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  category VARCHAR(50) NOT NULL,
  body TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_category (category)
);

CREATE TABLE IF NOT EXISTS jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ticket_id INT NOT NULL,
  engineer_id INT NOT NULL,
  scheduled_start DATETIME NOT NULL,
  site_postcode VARCHAR(10) NOT NULL,
  job_brief TEXT,
  status ENUM('scheduled','in_progress','completed','cancelled') NOT NULL DEFAULT 'scheduled',
  FOREIGN KEY (ticket_id)   REFERENCES tickets(id) ON DELETE CASCADE,
  FOREIGN KEY (engineer_id) REFERENCES users(id),
  INDEX idx_engineer_time (engineer_id, scheduled_start)
);