<table class="table">
    <thead>
        <tr class="row">
            <?php
            foreach ($tableRecords[0]->getDBFields() as $key) {
                echo '<th class="col-sm-12 col-md-2 ">' . ucwords($key) . '</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = current($tableRecords)) {
            ?>
            <tr class="row">
                <?php
                foreach ($row as $value) {
                    echo '<td class="col-sm-12 col-md-2">' . $value . '</td>';
                } ?>
            </tr>
            <?php
            next($tableRecords);
        }
        ?>
    </tbody>
</table>
