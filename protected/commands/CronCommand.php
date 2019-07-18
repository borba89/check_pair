<?php
class CronCommand extends CConsoleCommand {
    public function run($args) {
        $url = "http://cq.md/iquiz_tables/tables/backend/set_tables.php";
        $tables = array(28, 31, 24, 23, 33, 22);

        while(true) {
            foreach($tables as $table) {
                $post_data = array (
                    "tableId" => "17",
                    "team" => "Style gees",
                    "captain" => "Слава",
                    "phone" => "063485625",
                    "gameNum" => "139",
                    "gameType" => "qnq",
                );
                $post_data = json_encode($post_data);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($post_data))
                );

                $output = curl_exec($ch);
                curl_close($ch);
                echo $output;
            }
        }
    }
}