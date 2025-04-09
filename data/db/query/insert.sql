-- User  TABLE
INSERT INTO User (email, password, name, surname, token) VALUES
('john.doe@example.com', 'password123', 'John', 'Doe', 'token12345'),
('jane.smith@example.com', 'password456', 'Jane', 'Smith', 'token67890'),
('michael.jones@example.com', 'password789', 'Michael', 'Jones', 'token11223'),
('lisa.white@example.com', 'password101', 'Lisa', 'White', 'token44556'),
('tom.green@example.com', 'password202', 'Tom', 'Green', 'token78901'),
('emily.brown@example.com', 'password303', 'Emily', 'Brown', 'token23456'),
('david.miller@example.com', 'password404', 'David', 'Miller', 'token56789'),
('susan.martin@example.com', 'password505', 'Susan', 'Martin', 'token89012'),
('robert.clark@example.com', 'password606', 'Robert', 'Clark', 'token12367'),
('alice.davis@example.com', 'password707', 'Alice', 'Davis', 'token89123');

-- Startup TABLE
INSERT INTO Startup (name, description, category, email, owner_id) VALUES
('Techify', 'A tech startup focused on software solutions', 'Technology', 'contact@techify.com', 1),
('FoodHub', 'An innovative platform for food delivery', 'Food & Beverage', 'contact@foodhub.com', 2),
('GreenEnergy', 'Promoting clean energy solutions', 'Environment', 'contact@greenenergy.com', 3),
('ShopEase', 'An e-commerce platform for everyday shopping', 'Retail', 'contact@shopease.com', 4),
('EduVibe', 'A platform for online learning and education', 'Education', 'contact@eduvibe.com', 5),
('FinSolve', 'Financial solutions for small businesses', 'Finance', 'contact@finsolve.com', 6),
('HealthNet', 'A health-tech startup focused on improving healthcare access', 'Healthcare', 'contact@healthnet.com', 7),
('MoveFast', 'Logistics and transportation startup', 'Logistics', 'contact@movefast.com', 8),
('Artify', 'An online platform for selling art and crafts', 'Arts', 'contact@artify.com', 9),
('SmartFarm', 'A startup for smart agricultural technology', 'Agriculture', 'contact@smartfarm.com', 10);

-- Interaction TABLE
INSERT INTO Interaction (startup_id, user_id, type) VALUES
(1, 1, 'like'),
(1, 2, 'repost'),
(2, 3, 'save'),
(2, 4, 'like'),
(3, 5, 'save'),
(3, 6, 'repost'),
(4, 7, 'like'),
(4, 8, 'save'),
(5, 9, 'repost'),
(5, 10, 'like');

-- Investment TABLE

INSERT INTO Investment (investor_id, startup_id, percentage, amount, status, message) VALUES
(1, 1, 10.00, 50000.00, 'pending', 'Looking forward to this investment'),
(2, 2, 5.00, 20000.00, 'accepted', 'Excited to see the growth'),
(3, 3, 7.50, 35000.00, 'rejected', 'Not convinced with the business model'),
(4, 4, 15.00, 75000.00, 'pending', 'Lets discuss further'),
(5, 5, 20.00, 100000.00, 'accepted', 'Impressed by the vision'),
(6, 6, 10.00, 60000.00, 'pending', 'Looking for more details'),
(7, 7, 8.00, 40000.00, 'accepted', 'Great potential in healthcare'),
(8, 8, 12.50, 62500.00, 'rejected', 'Not interested in logistics'),
(9, 9, 6.00, 30000.00, 'accepted', 'Art market is booming'),
(10, 10, 10.00, 50000.00, 'pending', 'Smart farming could change the game');

-- Comment TABLE

INSERT INTO Comment (owner_id, startup_id, message) VALUES
(1, 1, 'Great concept, looking forward to seeing it grow!'),
(2, 2, 'I love the idea of quick and efficient food delivery!'),
(3, 3, 'Clean energy is the future, count me in!'),
(4, 4, 'E-commerce is booming, wish you the best!'),
(5, 5, 'Online learning is the future, great initiative!'),
(6, 6, 'Small businesses need more financial solutions, great idea!'),
(7, 7, 'Healthcare innovation is always needed, good luck!'),
(8, 8, 'I hope logistics improve with this idea, all the best!'),
(9, 9, 'This is amazing, can’t wait to see more artists on this platform!'),
(10, 10, 'Agriculture innovation is crucial, best of luck!');