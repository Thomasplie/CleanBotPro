CREATE TABLE robot_tasks (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             task_name VARCHAR(100) NOT NULL,
                             day TINYINT NOT NULL,         -- 1=Monday … 7=Sunday
                             time TIME NOT NULL
);

-- Use this to make a new table
