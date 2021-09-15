
-- 購入履歴画面

CREATE TABLE `orders` (
    `id` int(11) AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 購入詳細画面

CREATE TABLE `order_details`(
    `order_id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `price` int(11) NOT NULL,
    `amount` int(11)NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;