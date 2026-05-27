INSERT INTO hashing_function (name, min_length, max_length, type) VALUES
('MD5', 32, 32, 'Merkle-Damgård'),
('RIPEMD-160', 40, 40, 'Merkle-Damgård'),
('SHA-256', 64, 64, 'Merkle-Damgård'),
('SHA-1', 40, 40, 'Merkle-Damgård'),
('SHA-512', 128, 128, 'Merkle-Damgård'),
('SHA-3-256', 64, 64, 'Sponge'),
('SHA-3-512', 128, 128, 'Sponge'),
('BLAKE2b', 128, 128, 'HAIFA'),
('BLAKE2s', 64, 64, 'HAIFA'),
('Whirlpool', 128, 128, 'Miyaguchi-Preneel');