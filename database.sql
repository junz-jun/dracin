CREATE DATABASE IF NOT EXISTS drakor_china;
USE drakor_china;

CREATE TABLE dramas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    release_year INT,
    rating DECIMAL(3,1),
    poster_url VARCHAR(500),
    banner_url VARCHAR(500),
    status VARCHAR(50),
    total_episodes INT,
    age_rating VARCHAR(10),
    is_trending BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE drama_genres (
    drama_id INT,
    genre_id INT,
    PRIMARY KEY (drama_id, genre_id),
    FOREIGN KEY (drama_id) REFERENCES dramas(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
);

CREATE TABLE episodes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    drama_id INT,
    episode_number INT,
    title VARCHAR(255),
    video_url VARCHAR(500),
    thumbnail_url VARCHAR(500),
    duration VARCHAR(50),
    FOREIGN KEY (drama_id) REFERENCES dramas(id) ON DELETE CASCADE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    avatar_url VARCHAR(500),
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Seed data
INSERT INTO genres (name) VALUES ('Romance'), ('Historical'), ('Wuxia'), ('Xianxia'), ('Modern'), ('Drama');

INSERT INTO dramas (title, description, release_year, rating, poster_url, banner_url, status, total_episodes, age_rating, is_trending) VALUES
('Love Like The Galaxy', 'Kisah Cheng Shaoshang yang dibesarkan sendiri di tengah konflik keluarga, menemukan cinta dan jati diri bersama Jenderal Ling Buyi di tengah intrik kerajaan yang berbahaya.', 2022, 9.8, 'https://lh3.googleusercontent.com/aida-public/AB6AXuB0r7SdwnnH_IGIutD9jTjX7xiO8EapnuT8uCplAfnynblwdCHwbUNl960TDokAVTip4MA60zmK_t-xmPqElqhmnaPLpXzqNmUptApzsgJETKtHKHkpvXWjSsfbAHq5S7OwPBNXllc8wgqXVpJ-p5V9HQ7BbutRDAF_8rkJfvlu2DA9BEtcUODvcyavLxn6PYnB8prTXt-bFgTzKdgx6QoYP3-VvjT3TxOqehJBnDh-x-ygOYbXeUbNRATCnHgarqI0LTunP863dCk3', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCTljH9lN9sKjj8Z7yPwvxf_0vnUrkRjOQsPyJmoC7DfILqJIsLRaIUlm7VAEiiesyITzv_upOTbLI1SeEFbr3ITVFlDqnmF55--sdWf8P1TK2fl3FLQr0edC0dG3Zny5QmjXRo9VKf3SMySOky2vpiB_fqDVFQnIMWY6M_GOkWYXUfeAK38pLG_Dmp1vzDrrvNkQ_LLm6Tes-BJdj5oxwxGJuTyhAAMcaBIaCJGTsKftDsm016Fn-JlGvFDkG6GRynX3w3IbzasZ9F', 'Tamat', 56, '13+', TRUE),
('Who Rules The World', 'Drama wuxia romansa yang menceritakan tentang dua pahlawan bela diri yang terjebak dalam perebutan kekuasaan dunia persilatan.', 2022, 9.5, 'https://lh3.googleusercontent.com/aida-public/AB6AXuBLB_iupKVXProyttNOxBMhsVxB_Mh_AmUtF2hLMgdc5WK0gTTO_ycOmrDUghIYZzjHxvDPn0m9imdRENd3zTs7-Mla4vB7kEVCbaT0lC7Jdk2zezJR06GKS42rv70Cj6zv4tNe9F8DEYLMEgV99EJDAif14eUq6agHFIa2DYQw6KhECUcvejXTsdFtKk_biTpIEedFHjxMvwpddqePfPivlhNE-QHThVCIJbM4BcQajNTe4ThyFrsXaAbU_JypeFoB_hize2GRKRNm', '', 'Tamat', 40, '13+', FALSE),
('Hidden Love', 'Kisah cinta manis antara Sang Zhi dan teman kakaknya, Duan Jiaxu, yang bersemi sejak masa remaja hingga dewasa.', 2023, 9.8, 'https://lh3.googleusercontent.com/aida-public/AB6AXuAe8wZqeXwNgiZy51I16c2JesvoR24bT5WY2MikjDHpGA_H2PP88W5Xb7ADVG5-9MmdB1pTA8oHf2OyH3XKpymOOorRY8Nr4j8VdQbx9uMuSuvPKoqxaVVTJ4YCeOOEM8qj-PgYEAc_EjHtx3tLVBj-Zaw7uWMk5AB_d-kfSLP6ubeySR0YJbxGSk3aQ2v2utJthrarvAD0TXaCt8RbxJZ6NI5mNBRTLVoWkUX65GU33zTan66UoTvAzkM4y1E1QNHeOjR_Uc6ZLlOy', '', 'Tamat', 25, '13+', FALSE),
('Story of Kunning Palace', 'Jiang Xuening yang ambisius mendapatkan kesempatan kedua untuk memperbaiki masa lalunya setelah kematian yang tragis.', 2023, 9.2, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCcHuisTeJcpqfAhPXG6Ch2Se4qfca6jRKF7-9qhB4VVlgD8JguIvQxtm5a8-K1vUBKa_tFcK3h-F6XzhF7HiD2Z8iK0IHOEG99-OkflXZhH0zKLembFPRlt1BVHGuyDOQIpN2YB08FLfNpOa93LQ1Hu3bNz_cMqDr9E5AfkPWHP84IWlXoeUDTu-EaqV7PFrTz_PLRdmi1CCm5k9rgdFdOEF1jeSkWMAXvjknQ2Hn51I6kENU3c8TK06_jhHMPYeUyFbpsZvfXmcJp', '', 'Ongoing', 38, '13+', FALSE),
('The Untamed', 'Wei Wuxian dan Lan Wangji berpetualang untuk mengungkap misteri masa lalu yang kelam di dunia kultivasi.', 2019, 9.9, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDEju0Rn3MhKXOifRN7GoIZtJB8Fwmb_cCGhdI2MFSS3PlR_qcL280HA0fXDiJhQi4J1-6fEpqlRSRZkNECv2hdftBE1IXEmTVxDRaOz8mygeD8Lr_4W8YPoYZ_nonCz6cCheE_I0mzKUGs5z_xYFyRr2NE1BRjtTOgoN8wLDmSP9zF15Nc-e1NlUlpyuQQT8u3pSgO4cp_Nmw3lTIhdfUy-_MJDtXpHtD-P0wY-AL_dxO-jvyIO8wKGz4gqj8FTXUBszjYCNx5Seu5', '', 'Tamat', 50, '13+', FALSE);

-- Add some episodes for Love Like The Galaxy (id=1)
INSERT INTO episodes (drama_id, episode_number, title, video_url, thumbnail_url, duration) VALUES
(1, 1, 'Episode 1', '#', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBk2akXV1j6r_xkNZY-yAPBSXvFMCVhAcMfPhGPtLsJXKShGWllp59TjvO6XRpPSWinWpwuciUGkHhTAgGKB_lDov8-tlvkD72nKd6IWpbWuQh9T9abJbZSYuXWjJB7MnCsigILgPwzZOSAH2fxjnK2JpZedMboC3Y9ueJ1iZiyx_jqJy_XCduPeYL4cY1MaYVIGH3G3v6VQ5-py9gfNSCJsxsPANdwsFCqIW8gCGWTUMvwz7wjTKOmfBg4K8-Q-2KNQLh8J1WKBnuk', '45:00'),
(1, 2, 'Episode 2', '#', '', '45:00'),
(1, 3, 'Episode 3', '#', '', '45:00'),
(1, 4, 'Episode 4', '#', '', '45:00');

-- Genres for Love Like The Galaxy
INSERT INTO drama_genres (drama_id, genre_id) VALUES (1, 2), (1, 1);
INSERT INTO drama_genres (drama_id, genre_id) VALUES (2, 3), (2, 1);
INSERT INTO drama_genres (drama_id, genre_id) VALUES (3, 1), (3, 5);
INSERT INTO drama_genres (drama_id, genre_id) VALUES (4, 2), (4, 1);
INSERT INTO drama_genres (drama_id, genre_id) VALUES (5, 3), (5, 4);

-- Seed user
INSERT INTO users (username, email, avatar_url) VALUES ('Budi Santoso', 'budi@example.com', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAVHIRt4BzjgoLfO6MCVcj50FDZsHsOsxFtdnVUfCSGiyoPGRUoo9SRDeZgMCvuQLlYZxZZOLByl_9YZYEtdDijMeFEV4aXSlwYOU0lAszHPIJhXVIpqPHOcETauNXCt6B7At41PAHqeSODua8OUFSV2JVainy07HX3dsS5h81HrCL1q6naxbwluZl1InoUEnLHbom9iD7ot5caui01eVYubg8QUGQ8Qv7ACW7RjCbIrC2XOlzXJraxE_GlTo0aL8jnlCn8WWlXpnVZ');
