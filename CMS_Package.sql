-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2019 at 05:59 PM
-- Server version: 5.7.23
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanfordwebsolutions`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `owner`, `content`, `images`, `type`, `selected`, `created_at`, `updated_at`) VALUES
(19, 'frezknow@gmail.com', '<div>Th<font size=\"5\">e hills grow bigger. And just before we come to the island, we </font>can see the silhouette of that fig tree up there, along the crest of that hill.”</div><div></div><div>“Good girl!” said Larth, proud of his daughter’s memory and powers of observation. He was a strong, handsome man with flecks of gray in his black beard. His wife had borne several children, but all had died very young except Lara, the last, whom his wife had died bearing. Lara was very precious to him. Like her mother, she had golden hair. Now that she had reached the age of childbearing, Lara was beginning to display the fullness of a woman’s hips and breasts. It was Larth’s greatest wish that he might live to see his own grandchildren. Not every man lived that long, but Larth was hopeful. He had been healthy all his life, partly, he believed, because he had always been careful to show respect to the numina he encountered on his journeys.</div><div></div><div>Respecting the numina was important. The numen of the river could suck a man under and drown him. The numen of a tree could trip a man with its roots, or drop a rotten branch on his head. Rocks could give way underfoot, chuckling with amusement at their own treachery. Even the sky, with a roar of fury, sometimes sent down fingers of fire that could roast a man like a rabbit on a spit, or worse, leave him alive but robbed of his senses. Larth had heard that the earth itself could open and swallow a man; though he had never actually seen such a thing, he nevertheless performed a ritual each morning, asking the earth’s permission before he went striding across it.</div><div></div><div>“There’s something so special about this place,” said Lara, gazing at the sparkling river to her left and then at the rocky, tree-spotted hills ahead and to her right. “How was it made? Who made it?”</div><div></div><div>Larth frowned. The question made no sense to him. A place was never made, it simply was. Small features might change over time. Uprooted by a storm, a tree might fall into the river. A boulder might decide to tumble down the hillside. The numina that animated all things went about reshaping the landscape from day to day, but the essential things never changed, and had always existed: the river, the hills, the sky, the sun, the sea, the salt beds at the mouth of the river.</div><div></div><div>He was trying to think of some way to express these thoughts to Lara, when a deer, drinking at the river, was startled by their approach. The deer bolted up the brushy bank and onto the path. Instead of running to safety, the creature stood and stared at them. As clearly as if the animal had whispered aloud, Larth heard the words “Eat me.” The deer was offering herself.</div><div></div><div>Larth turned to shout an order, but the most skilled hunter of the group, a youth called Po, was already in motion. Po ran forward, raised the sharpened stick he always carried and hurled it whistling through the air between Larth and Lara.</div><div></div><div>A heartbeat later, the spear struck the deer’s breast with such force that the creature was knocked to the ground. Unable to rise, she thrashed her neck and flailed her long, slender legs. Po ran past Larth and Lara. When he reached the deer, he pulled the spear free and stabbed the creature again. The deer released a stifled noise, like a gasp, and stopped moving.</div><div></div><div>There was a cheer from the group. Instead of yet another dinner of fish from the river, tonight there would be venison.</div><div></div><div></div><div></div><div>The distance from the riverbank to the island was not great, but at this time of year—early summer—the river was too high to wade across. Lara’s people had long ago made simple rafts of branches lashed together with leather thongs, which they left on the riverbanks, repairing and replacing them as needed. When they last passed this way, there had been three rafts, all in good condition, left on the east bank. Two of the rafts were still there, but one was missing.</div><div></div><div>“I see it! There—pulled up on the bank of the island, almost hidden among those leaves,” said Po, whose eyes were sharp. “Someone must have used it to cross over.”</div><div></div><div>“Perhaps they’re still on the island,” said Larth. He <font color=\"#cc9966\">did not begrudge others the use of the rafts, and the island was large enough to share. Nonetheless, the situation required caution. He cupped his hands to his mouth and gave a shout. It was not long </font>before a man appeared on the bank of the island. The man waved.</div>', '', '', 0, '2019-05-02 20:51:28', '2019-05-19 12:37:02'),
(22, 'frezknow@gmail.com', '#ffffff', '', '.CMSHeader', 0, NULL, '2019-05-18 00:48:08'),
(25, 'frezknow@gmail.com', '#46bf5f', '', '#aboutContent', 0, NULL, '2019-05-06 23:08:41'),
(59, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582179164k-wallpaper-abstract-abstract-painting-1451567.jpg', 'body', 0, '2019-05-18 21:18:36', '2019-05-18 22:00:35'),
(60, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582179694k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 21:19:29', '2019-05-18 21:21:40'),
(62, 'frezknow@gmail.com', '', 'uploads/backgrounds/1558218100aerial-architecture-bridge-1473673.jpg', 'body', 0, '2019-05-18 21:21:40', '2019-05-18 21:22:16'),
(63, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582181364k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 21:22:16', '2019-05-18 21:24:33'),
(64, 'frezknow@gmail.com', '', 'uploads/backgrounds/1558218273abstract-business-code-270348.jpg', 'body', 0, '2019-05-18 21:24:33', '2019-05-18 21:26:56'),
(65, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582184164k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 21:26:56', '2019-05-18 21:28:40'),
(66, 'frezknow@gmail.com', '', 'uploads/backgrounds/1558218520fog-foggy-forest-158607.jpg', 'body', 0, '2019-05-18 21:28:40', '2019-05-18 21:29:20'),
(68, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582185604k-wallpaper-abstract-abstract-painting-1451567.jpg', 'body', 0, '2019-05-18 21:29:20', '2019-05-18 21:33:30'),
(69, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582188104k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 21:33:30', '2019-05-18 21:34:39'),
(70, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582188794k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 21:34:39', '2019-05-18 21:35:29'),
(71, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582189294k-wallpaper-abstract-abstract-painting-1451567.jpg', 'body', 0, '2019-05-18 21:35:29', '2019-05-18 21:37:42'),
(73, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582190624k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 21:37:42', '2019-05-18 21:38:14'),
(74, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582190944k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 21:38:14', '2019-05-18 21:41:50'),
(75, 'frezknow@gmail.com', '', 'uploads/backgrounds/1558219310aerial-architecture-bridge-1473673.jpg', 'body', 0, '2019-05-18 21:41:50', '2019-05-18 21:44:41'),
(77, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582194814k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 21:44:41', '2019-05-18 21:48:26'),
(78, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582197064k-wallpaper-abstract-abstract-painting-1451567.jpg', 'body', 0, '2019-05-18 21:48:26', '2019-05-18 21:49:17'),
(79, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582197574k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 21:49:17', '2019-05-18 21:49:57'),
(80, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582197974k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 21:49:57', '2019-05-18 21:50:36'),
(81, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582198364k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 21:50:36', '2019-05-18 21:54:54'),
(82, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582200944k-wallpaper-abstract-abstract-painting-1451567.jpg', 'body', 0, '2019-05-18 21:54:54', '2019-05-18 21:55:49'),
(83, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582201494k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 21:55:49', '2019-05-18 21:56:30'),
(84, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582201904k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 21:56:30', '2019-05-18 21:57:03'),
(85, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582202234k-wallpaper-abstract-abstract-painting-1451567.jpg', 'body', 0, '2019-05-18 21:57:03', '2019-05-18 21:57:36'),
(86, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582202564k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 21:57:36', '2019-05-18 21:58:08'),
(87, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582204354k-wallpaper-afterglow-blur-1236701.jpg', 'body', 0, '2019-05-18 22:00:35', '2019-05-18 22:01:22'),
(88, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582204824k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 0, '2019-05-18 22:01:22', '2019-05-18 22:05:51'),
(89, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582207514k-wallpaper-abstract-abstract-painting-1451567.jpg', 'body', 1, '2019-05-18 22:05:51', '2019-05-18 22:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `owner`, `content`, `images`, `type`, `selected`, `created_at`, `updated_at`) VALUES
(1, 'frezknow@gmail.com', '<font color=\"#ffffff\">i0aduchua9hcaduhcdacac</font><div><font color=\"#ffffff\" size=\"5\">acjiodajcidhcchs</font></div><div><font color=\"#ffffff\" size=\"5\">ijjsivodsvshdv</font></div><div><font color=\"#ffffff\" size=\"5\">juhsoudsvhudshvosd</font></div><div><font color=\"#ffffff\" size=\"5\">sivhsdohvhsdvsd</font></div><div><font color=\"#ffffff\" size=\"5\">sdjvhdsvhoisdhv</font></div><div><font color=\"#ffffff\" size=\"5\">s</font></div><div><font color=\"#ffffff\" size=\"5\"><br></font></div><div><font color=\"#ffffff\" size=\"5\"><br></font></div><div><font color=\"#ffffff\" size=\"5\">sdvijisdvisdvhdshvds</font></div><div><font color=\"#ffffff\" size=\"5\"><br></font></div><div><font color=\"#ffffff\"><font size=\"5\">sivhudshvuhdsovdshvhvuosduhvosdu</font>ohvuodshvhdsuvhudshvosdhvudshvuodshvudshuvhdshvhvshvudshvdsuhv sdjivdsihvdsuhvhuds</font></div>', '', '', 0, '2019-04-29 04:00:00', '2019-05-19 12:33:00'),
(3, 'frezknow@gmail.com', '#c0c0c0', '', '.CMSHeader', 0, NULL, '2019-05-06 23:10:30'),
(4, 'frezknow@gmail.com', '#8080ff', '', '.contactContent', 0, NULL, '2019-05-15 01:51:54'),
(5, 'frezknow@gmail.com', 'Email us below', '', '#ContactFormVerbage', 0, NULL, '2019-05-13 23:51:22'),
(11, 'frezknow@gmail.com', '', 'uploads/backgrounds/15582207364k-wallpaper-aerial-photography-architecture-1518500.jpg', 'body', 1, '2019-05-18 22:05:36', '2019-05-18 22:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `layouts` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `img`, `layouts`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Nathan Reynolds', 'frezknow@gmail.com', '', '0,0,0', '$2y$10$KGXkrF1w1jUslwkUrICGOuMFvOVLcA5ulRK6a7Z6USioVO2ao/AnW', '2019-04-12 19:26:57', '2019-05-18 18:13:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `welcomes`
--

CREATE TABLE `welcomes` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `welcomes`
--

INSERT INTO `welcomes` (`id`, `owner`, `content`, `type`, `images`, `selected`, `created_at`, `updated_at`) VALUES
(30, 'frezknow@gmail.com', '#ffffff', '.CMSHeader', '', 0, NULL, '2019-05-06 23:16:37'),
(31, 'frezknow@gmail.com', '#ffffff', '#welcomeContent', '', 0, NULL, '2019-05-07 19:11:00'),
(32, 'frezknow@gmail.com', '<div><font size=\"5\">Soon Lara spotted other landmarks—an outcropping of limestone beside the path that had a silhouette like a man’s face, a marshy spot beside the river where the waterfowl were easily startled, a tall tree that looked like a man with his arms upraised. They were drawing near to the place where there was an island in the river. <font color=\"#ff0000\">The island was a good spot to make camp. They would sleep on the island tonight.</font></font></div><div></div><div><font color=\"#ff0000\" size=\"5\">Lara had been back and forth along the river path many times in her short life. Her people had not created the path—it had always been there, like the river—but their deerskin-shod feet and the wooden wheels of their handcarts kept the path well worn. Lara’s people were salt traders, and their livelihood took them on a continual journey.</font></div><div></div><div><b><font size=\"5\">At the mouth of the river, the little group of half a dozen intermingled families gathered salt from the great salt beds beside the sea. They groomed and sifted the salt and loaded it into handcarts. When the carts were full, most of the group would stay behind, taking shelter amid rocks and simple lean-tos, while a band of fifteen or so of the heartier members set out on the path that ran alongside the river.</font></b></div><div></div><div><font size=\"5\"><b>With their precious cargo of salt, the travelers crossed the coastal lowlands and traveled toward the mountains. But Lara’s people never reached the mountaintops; they traveled only as far as the foothills. Many people lived in the forests and grassy meadows of the foothills, gathered in small villages.</b> In return for salt, these people would give Lara’s people dried meat, animal skins, cloth spun from wool, clay pots, needles and scraping tools carved from bone, and little toys made of wood.</font></div><div></div><div><font size=\"5\">Their bartering done, Lara and her people would travel back down the river path to the sea. The cycle would begin again.</font></div><div></div><div><font size=\"5\">It had always been like this. Lara knew no other life. She traveled back and forth, up and down the river path. No single place was home. She liked the seaside, where there was always fish to eat, and the gentle lapping of the waves lulled her to sleep at night. She was less fond of the foothills, where the path grew steep, the nights could be cold, and views of great distances made her dizzy. She felt uneasy in the villages, and was often shy around strangers. The path itself was where she felt most at home. She loved the smell of the river on a hot day, and the croaking of frogs at night. Vines grew amid the lush foliage along the river, with berries that were good to eat. Even on the hottest day, sundown brought a cool breeze off the water, which sighed and sang amid the reeds and tall grasses.</font></div><div></div><div><font size=\"5\">Of all the places along the path, the area they were approaching, with the island in the river, was Lara’s favorite.</font></div><div></div><div><font size=\"5\">The terrain along this stretch of the river was mostly flat, but in the immediate vicinity of the island, the land on the sunrise side was like a rumpled cloth, with hills and ridges and valleys. Among Lara’s people, there was a wooden baby’s crib, suitable for strapping to a cart, that had been passed down for generations. The island was shaped like that crib, longer than it was wide and pointed at the upriver end, where the flow had eroded both banks. The island was like a crib, and the group of hills on the sunrise side of the river were like old women mantled in heavy cloaks gathered to have a look at the baby in the crib—that was how Lara’s father had once described the lay of the land.</font></div>', '', '$!$uploads/15571874064k-wallpaper-afterglow-blur-1236701.jpg', 0, '2019-05-06 23:03:26', '2019-05-19 12:34:14'),
(36, 'frezknow@gmail.com', '', 'body', 'uploads/backgrounds/15582203024k-wallpaper-abstract-abstract-painting-1451567.jpg', 0, '2019-05-18 21:58:22', '2019-05-18 22:00:00'),
(37, 'frezknow@gmail.com', '', 'body', 'uploads/backgrounds/15582204004k-wallpaper-aerial-photography-architecture-1518500.jpg', 0, '2019-05-18 22:00:00', '2019-05-18 22:01:58'),
(38, 'frezknow@gmail.com', '', 'body', 'uploads/backgrounds/15582205184k-wallpaper-afterglow-blur-1236701.jpg', 0, '2019-05-18 22:01:58', '2019-05-18 22:03:11'),
(39, 'frezknow@gmail.com', '', 'body', 'uploads/backgrounds/15582205914k-wallpaper-abstract-abstract-painting-1451567.jpg', 0, '2019-05-18 22:03:11', '2019-05-18 22:04:30'),
(40, 'frezknow@gmail.com', '', 'body', 'uploads/backgrounds/15582206704k-wallpaper-afterglow-blur-1236701.jpg', 0, '2019-05-18 22:04:30', '2019-05-18 22:04:49'),
(41, 'frezknow@gmail.com', '', 'body', 'uploads/backgrounds/15582206894k-wallpaper-abstract-abstract-painting-1451567.jpg', 1, '2019-05-18 22:04:49', '2019-05-18 22:04:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `welcomes`
--
ALTER TABLE `welcomes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `welcomes`
--
ALTER TABLE `welcomes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
