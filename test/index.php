<?php
// =============================================
// ПРОСТЫЕ ФИЛЬТРЫ ДЛЯ ПОКЕМОНОВ
// =============================================

// Подключаемся к базе
$conn = mysqli_connect('localhost', 'root', '', 'simple_pokemon');

// СОЗДАЕМ ФИЛЬТРЫ (самая важная часть!)
// =============================================

// 1. Фильтр по типу
$type_filter = '';
if (isset($_GET['type']) && $_GET['type'] != '') {
    $selected_type = $_GET['type'];
    $type_filter = "AND (type1 = '$selected_type' OR type2 = '$selected_type')";
}

// 2. Фильтр по способности
$ability_filter = '';
if (isset($_GET['ability']) && $_GET['ability'] != '') {
    $selected_ability = $_GET['ability'];
    $ability_filter = "AND ability = '$selected_ability'";
}

// 3. Поиск по имени
$search_filter = '';
if (isset($_GET['search']) && $_GET['search'] != '') {
    $search_text = $_GET['search'];
    $search_filter = "AND name LIKE '%$search_text%'";
}

// СОБИРАЕМ ВСЕ ФИЛЬТРЫ В ОДИН ЗАПРОС
$sql = "SELECT * FROM pokemon WHERE 1=1 
        $type_filter 
        $ability_filter 
        $search_filter 
        ORDER BY number";

$result = mysqli_query($conn, $sql);

// ПОЛУЧАЕМ ВСЕ ТИПЫ ДЛЯ ВЫПАДАЮЩЕГО СПИСКА
$types_sql = "SELECT DISTINCT type1 as t FROM pokemon 
              UNION 
              SELECT DISTINCT type2 as t FROM pokemon 
              WHERE type2 IS NOT NULL 
              ORDER BY t";
$types = mysqli_query($conn, $types_sql);

// ПОЛУЧАЕМ ВСЕ СПОСОБНОСТИ ДЛЯ ВЫПАДАЮЩЕГО СПИСКА
$abilities = mysqli_query($conn, "SELECT DISTINCT ability FROM pokemon ORDER BY ability");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Покемоны с фильтрами</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }

        /* Стили для фильтров */
        .filters {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .filter-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        select, input, button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover { background: #45a049; }
        .reset {
            background: #f44336;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        /* Стили для карточек */
        .pokemon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card img { width: 100px; height: 100px; }
        .number { color: #666; font-size: 14px; }
        h3 { margin: 10px 0; color: #333; }
        .type {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
            margin: 2px;
            color: white;
        }
        .Grass { background: #78C850; }
        .Poison { background: #A040A0; }
        .Fire { background: #F08030; }
        .Water { background: #6890F0; }
        .Electric { background: #F8D030; color: #333; }
        .Bug { background: #A8B820; }
        .Flying { background: #A890F0; }
        .Normal { background: #A8A878; }
        .count {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="text-align: center;">🔍 Покемоны с фильтрами</h1>

    <!-- ========== ФОРМА С ФИЛЬТРАМИ ========== -->
    <div class="filters">
        <form method="GET" action="">
            <div class="filter-row">
                <!-- Поиск по имени -->
                <input type="text"
                       name="search"
                       placeholder="Поиск по имени..."
                       value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

                <!-- Фильтр по типу -->
                <select name="type">
                    <option value="">Все типы</option>
                    <?php
                    while ($type = mysqli_fetch_assoc($types)) {
                        $selected = (isset($_GET['type']) && $_GET['type'] == $type['t']) ? 'selected' : '';
                        echo "<option value='{$type['t']}' $selected>{$type['t']}</option>";
                    }
                    ?>
                </select>

                <!-- Фильтр по способности -->
                <select name="ability">
                    <option value="">Все способности</option>
                    <?php
                    while ($ability = mysqli_fetch_assoc($abilities)) {
                        $selected = (isset($_GET['ability']) && $_GET['ability'] == $ability['ability']) ? 'selected' : '';
                        echo "<option value='{$ability['ability']}' $selected>{$ability['ability']}</option>";
                    }
                    ?>
                </select>

                <!-- Кнопки -->
                <button type="submit">Применить фильтры</button>
                <a href="?" class="reset">Сбросить</a>
            </div>
        </form>
    </div>

    <!-- Счетчик результатов -->
    <?php
    $count = mysqli_num_rows($result);
    echo "<div class='count'>Найдено покемонов: <strong>$count</strong></div>";
    ?>

    <!-- ========== ВЫВОД ПОКЕМОНОВ ========== -->
    <div class="pokemon-grid">
        <?php
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <span class="number">#<?php echo $row['number']; ?></span>
                    <img src="<?php echo $row['picture']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3><?php echo $row['name']; ?></h3>
                    <div>
                        <span class="type <?php echo $row['type1']; ?>"><?php echo $row['type1']; ?></span>
                        <?php if ($row['type2']): ?>
                            <span class="type <?php echo $row['type2']; ?>"><?php echo $row['type2']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div style="font-size: 12px; color: #666; margin-top: 5px;">
                        <?php echo $row['ability']; ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p style='grid-column: 1/-1; text-align: center;'>Ничего не найдено</p>";
        }
        ?>
    </div>
</div>
</body>
</html>