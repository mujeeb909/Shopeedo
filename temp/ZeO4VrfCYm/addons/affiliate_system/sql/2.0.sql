INSERT INTO `affiliate_configs` (`id`, `type`, `value`, `created_at`, `updated_at`) 
            VALUES (NULL, 'minimum_affiliate_withdraw_amount', 0, current_timestamp(), current_timestamp());

COMMIT;