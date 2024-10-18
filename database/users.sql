
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$YkU3RfHNbvzW0thdELJX4uM7NxCBWo0R14F/kLDkHZCVtwnHkM5C6', '2024-10-17 04:22:23'),
(2, 'hazel', '$2y$10$/wY4Hemtr1Tnu08mK5u1nOxBO5ZLTiRWaGZkAleXcmTrZ7W5Im052', '2024-10-17 04:47:43'),
(3, 'mj', '$2y$10$3cWXpOxt8gcTTDD6OF30n.eREIHq0OeBr6.Pu9MxDJO/Y86Vfqsii', '2024-10-17 06:11:13');


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

