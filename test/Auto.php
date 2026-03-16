<?php
// install.php - Запустите этот файл ОДИН РАЗ для создания базы данных

$host = 'localhost';
$user = 'root';        // Ваш логин MySQL
$pass = '';            // Ваш пароль MySQL (в XAMPP чаще всего пусто)
$db = 'pokemon_db';

// Подключаемся к MySQL
$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("❌ Ошибка подключения: " . mysqli_connect_error());
}

// Создаем базу данных
$sql = "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (mysqli_query($conn, $sql)) {
    echo "✅ База данных '$db' создана или уже существует<br>";
} else {
    die("❌ Ошибка создания базы: " . mysqli_error($conn));
}

// Выбираем базу данных
mysqli_select_db($conn, $db);

// Создаем таблицу покемонов
$sql = "CREATE TABLE IF NOT EXISTS pokemon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    number INT NOT NULL UNIQUE,
    type1 VARCHAR(30) NOT NULL,
    type2 VARCHAR(30) NULL,
    ability VARCHAR(50) NOT NULL,
    species VARCHAR(100) NOT NULL,
    picture TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "✅ Таблица 'pokemon' создана<br>";
} else {
    die("❌ Ошибка создания таблицы: " . mysqli_error($conn));
}

// Очищаем таблицу перед вставкой (чтобы не было дубликатов)
mysqli_query($conn, "TRUNCATE TABLE pokemon");

// Вставляем данные покемонов
$pokemon_data = [
    ['Bulbasaur', 1, 'Grass', 'Poison', 'Overgrow', 'Seed Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'],
    ['Ivysaur', 2, 'Grass', 'Poison', 'Overgrow', 'Seed Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/2.png'],
    ['Venusaur', 3, 'Grass', 'Poison', 'Overgrow', 'Seed Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png'],
    ['Charmander', 4, 'Fire', NULL, 'Blaze', 'Lizard Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'],
    ['Charmeleon', 5, 'Fire', NULL, 'Blaze', 'Flame Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/5.png'],
    ['Charizard', 6, 'Fire', 'Flying', 'Blaze', 'Flame Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png'],
    ['Squirtle', 7, 'Water', NULL, 'Torrent', 'Tiny Turtle Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png'],
    ['Wartortle', 8, 'Water', NULL, 'Torrent', 'Turtle Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/8.png'],
    ['Blastoise', 9, 'Water', NULL, 'Torrent', 'Shellfish Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/9.png'],
    ['Caterpie', 10, 'Bug', NULL, 'Shield Dust', 'Worm Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png'],
    ['Metapod', 11, 'Bug', NULL, 'Shed Skin', 'Cocoon Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/11.png'],
    ['Butterfree', 12, 'Bug', 'Flying', 'Compound Eyes', 'Butterfly Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/12.png'],
    ['Weedle', 13, 'Bug', 'Poison', 'Shield Dust', 'Hairy Bug Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/13.png'],
    ['Kakuna', 14, 'Bug', 'Poison', 'Shed Skin', 'Cocoon Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/14.png'],
    ['Beedrill', 15, 'Bug', 'Poison', 'Swarm', 'Poison Bee Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/15.png'],
    ['Pidgey', 16, 'Normal', 'Flying', 'Keen Eye', 'Tiny Bird Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/16.png'],
    ['Pidgeotto', 17, 'Normal', 'Flying', 'Keen Eye', 'Bird Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/17.png'],
    ['Pidgeot', 18, 'Normal', 'Flying', 'Keen Eye', 'Bird Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/18.png'],
    ['Rattata', 19, 'Normal', NULL, 'Run Away', 'Mouse Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/19.png'],
    ['Raticate', 20, 'Normal', NULL, 'Run Away', 'Mouse Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/20.png'],
    ['Spearow', 21, 'Normal', 'Flying', 'Keen Eye', 'Tiny Bird Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/21.png'],
    ['Fearow', 22, 'Normal', 'Flying', 'Keen Eye', 'Beak Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/22.png'],
    ['Ekans', 23, 'Poison', NULL, 'Intimidate', 'Snake Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/23.png'],
    ['Arbok', 24, 'Poison', NULL, 'Intimidate', 'Cobra Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/24.png'],
    ['Pikachu', 25, 'Electric', NULL, 'Static', 'Mouse Pokémon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png']
];

foreach ($pokemon_data as $p) {
    $type2 = $p[3] ? "'" . $p[3] . "'" : "NULL";
    $sql = "INSERT INTO pokemon (name, number, type1, type2, ability, species, picture) VALUES (
        '{$p[0]}', 
        {$p[1]}, 
        '{$p[2]}', 
        $type2, 
        '{$p[4]}', 
        '{$p[5]}', 
        '{$p[6]}'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "✅ Добавлен: {$p[0]}<br>";
    } else {
        echo "❌ Ошибка добавления {$p[0]}: " . mysqli_error($conn) . "<br>";
    }
}

echo "<br>🎉 Установка завершена! <a href='index.php'>Перейти к просмотру покемонов</a>";

mysqli_close($conn);
?>