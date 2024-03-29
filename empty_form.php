<?php
$filter_param = isset($_GET['filter']) ? "?filter=" . $_GET['filter'] : ""; 
?>

<div class="task-form-wrap">
    <div class="link-back-wrap">
        <a class="link-back" href="index.php<?=$filter_param;?>"><img src="./img/cross_icon.png" alt="Закрыть"></a>
    </div>
    
    <form action="index.php?create=true" method="POST">
        <div class="form-row">
            <?php 
            $jsonFileAccessModel = new JsonFileAccessModel('users');
            $users = json_decode($jsonFileAccessModel->read(), true);
            $translators = array_filter($users, function($user) {
                return $user['role'] == 'translator';
            });
            ?>
            <label>
                Ответственный: 
                <select name="executor">
                    <option value="">Не назначать</option>
                    <?php 
                    foreach ($translators as $translator) {
                        $tasks_num = $tasksList->getTasksNum($translator['login']);
                        $selected = ($task['executor'] == $translator['login']) ? 'selected' : '';
                        echo '<option value="' . $translator['login'] . '"' . $selected . '>' . $translator['name'] . ' (' . $tasks_num . ')' . '</option>';
                    }
                    ?>
                </select>
            </label>
            <label>
                Клиент: 
                <input type="text" name="client" value="">
            </label>
        </div>

        <div class="form-row">
            <?php 
            $jsonFileAccessModel2 = new JsonFileAccessModel('languages');
            $languages = json_decode($jsonFileAccessModel2->read(), true);
            ?>
            <label>
                Язык оригинала:
                <?php 
                foreach ($languages as $value) {
                    echo '<label class="label-lang"><input type="radio" name="original_lang" value="' . $value['id'] . '" required />' . $value['name'] . '</label>';
                }
                ?>
            </label>
        </div>

        <div class="form-row">
            <label>
                Языки перевода:
                <?php 
                foreach ($languages as $key => $value) {
                    echo '<label class="label-lang"><input type="checkbox" name="translation_lang[' . $key . ']" value="' . $value['id'] . '" />' . $value['name'] . '</label>';
                }
                ?>
            </label>
        </div>
        <textarea name="text" id="" class="original-text" required></textarea>

        <div class="form-row">
            <div class="form-column"></div>
            <div class="form-column">
                <label>
                    Крайний срок
                    <input type="date" name="deadline" required />
                </label>
                <input class="save-button" type="submit" value="Сохранить" />
            </div>
        </div>
    </form>
</div>
