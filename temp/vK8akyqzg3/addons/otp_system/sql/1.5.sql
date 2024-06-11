CREATE TABLE `sms_templates` (
  `id` int(11) NOT NULL,
  `identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sms_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `template_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `sms_templates` (`id`, `identifier`, `sms_body`, `template_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'phone_number_verification', '[[code]] is your verification code for [[site_name]].', NULL, 0, '2021-06-07 13:29:22', '2021-06-08 02:38:18'),
(2, 'password_reset', 'Your password reset code is [[code]].', NULL, 1, '2021-06-07 13:29:34', '2021-06-07 13:29:34'),
(3, 'order_placement', 'Your order has been placed and Order Code is [[order_code]]', NULL, 1, '2021-06-07 13:32:22', '2021-06-08 02:39:25'),
(4, 'delivery_status_change', 'Your delivery status has been updated to [[delivery_status]]  for Order code : [[order_code]]', NULL, 1, '2021-06-07 13:33:14', '2021-06-08 02:39:28'),
(5, 'payment_status_change', 'Your payment status has been updated to [[payment_status]] for Order code : [[order_code]]', NULL, 1, '2021-06-07 13:35:23', '2021-06-08 02:39:31'),
(6, 'assign_delivery_boy', 'You are assigned to deliver an order. Order code : [[order_code]]', NULL, 1, '2021-06-07 13:38:10', '2021-06-08 02:39:34');

ALTER TABLE `sms_templates`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sms_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
