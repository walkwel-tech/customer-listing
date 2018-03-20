<?php
$table      = "customer";
$page_title = "Listing " . ucwords($table) . " table";

$limit        = (isset($_GET['limit'])) ? $_GET['limit'] : 10;
$currentPage  = (isset($_GET['page'])) ? $_GET['page'] : 1;

$prevPage = ($currentPage > 1) ? ($currentPage - 1) : 1;
$nextPage = $currentPage + 1;

$pageLimitOption = [10, 20, 25, 50, 100];

include './layouts/header.php';

if ($table) {
    try {
        $tableRecords = $table::findLimited($limit, $currentPage);
        $maxPages     = ceil($table::countAll() / $limit);
    } catch (Exception $e) {
        $tableRecords = null;
        $maxPages     = 0;
    }
}

?>
    <div class="container-fluid">
        <article id="details" class="panel">
            <div class="panel-heading">
                <h3 class="col-md-10">
                    <?php echo ucfirst($table); ?>
                </h3>
                <div class="col-md-2">
                    <form method="get">
                        <label for="record-limiter">Showing</label>
                        <select class="form-control" name="limit" id="record-limiter">
                        <?php
                        foreach ($pageLimitOption as $limiter) {
                            $checked = ($limiter == $limit) ? 'selected' : '';
                            echo '<option value="' . $limiter . '" ' . $checked . ' >' . $limiter . ' Records per page</option>';
                        }
                        ?>
                        </select>
                    </form>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <?php
                    if ($tableRecords) {
                        ?>
                        <?php
                        echo '<div class="table-responsive">';
                        include './layouts/table_render.php';
                        echo '</div>';
                    } else {
                        ?>
                        <p class="text-danger">
                            No records found...
                            <a href="./install.php" class="btn btn-sm btn-default">Install</a> Table first
                        </p>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <?php
            if ($tableRecords) {
                ?>
                <div class="panel-footer text-center">
                    <ul class="pagination">
                        <?php
                        if ($currentPage == 1) {
                            ?>
                            <li class="previous disabled">
                                <a href="javascript:void(0);"> &laquo; Previous</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="previous">
                                <a href="<?php echo pageQuery($prevPage); ?>"> &laquo; Previous</a>
                            </li>
                            <?php
                        }
                        for ($pagesCount = 1; $pagesCount <= $maxPages; $pagesCount++) {
                            ?>
                            <li class="<?php echo ($pagesCount == $currentPage) ? 'active' : ''; ?>">
                                <a href="<?php echo pageQuery($pagesCount); ?>">
                                    <?php
                                        echo $pagesCount;
                                    ?>
                                </a>
                            </li>
                            <?php
                        }
                        if ($currentPage == $maxPages) {
                            ?>
                            <li class="next disabled">
                                <a href="javascript:void(0);">Next &raquo;</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="next">
                                <a href="<?php echo pageQuery($nextPage); ?>">Next &raquo;</a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
                <?php
            }
            ?>

        </article>
    </div>

    <script>
        $(function(){
            $('select#record-limiter').change(function(){
                let form = $(this).parent('form');
                form.submit();
            });
        })
    </script>

    <?php
    include './layouts/footer.php';
