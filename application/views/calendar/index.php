<!-- index.php -->
<h2>Kalender</h2>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/styl.css'); ?>">

<?php
// Array nama bulan
$months = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

// Menghitung bulan sebelumnya dan selanjutnya
$prev_month = $month == 1 ? 12 : $month - 1;
$prev_year = $month == 1 ? $year - 1 : $year;
$next_month = $month == 12 ? 1 : $month + 1;
$next_year = $month == 12 ? $year + 1 : $year;
?>

<div class="calendar-navigation">
    <a class="prev" href="<?= site_url('calendar/index/' . $prev_month . '/' . $prev_year); ?>"><<</a>
    <span class="month-year"><?= $months[$month] . ' ' . $year; ?></span>
    <a class="next" href="<?= site_url('calendar/index/' . $next_month . '/' . $next_year); ?>">>></a>
</div>

<a href="<?= site_url('calendar/add'); ?>">Tambah Jadwal</a>
<table>
    <tr>
        <th>Minggu</th>
        <th>Senin</th>
        <th>Selasa</th>
        <th>Rabu</th>
        <th>Kamis</th>
        <th>Jumat</th>
        <th>Sabtu</th>
    </tr>
    <?php
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $first_day_of_month = date('w', strtotime("$year-$month-01"));
    $current_day = 1;

    for ($week = 0; $week < 6; $week++) {
        echo '<tr>';
        for ($day = 0; $day < 7; $day++) {
            if ($week == 0 && $day < $first_day_of_month) {
                echo '<td></td>';
            } elseif ($current_day > $days_in_month) {
                echo '<td></td>';
            } else {
                $date = sprintf("%04d-%02d-%02d", $year, $month, $current_day);
                echo '<td>' . $current_day;

                foreach ($schedules as $schedule) {
                    if ($schedule['date'] == $date) {
                        echo '<div class="event" onclick="showDescription(\'' . addslashes($schedule['event']) . '\', \'' . addslashes($schedule['description']) . '\')">' . $schedule['event'] . '</div>';
                        echo '<br><a href="' . site_url('calendar/edit/' . $schedule['id']) . '">Edit</a>';
                        echo ' | <a href="' . site_url('calendar/delete/' . $schedule['id']) . '" onclick="return confirm(\'Are you sure?\')">Hapus</a>';
                    }
                }

                echo '</td>';
                $current_day++;
            }
        }
        echo '</tr>';
        if ($current_day > $days_in_month) {
            break;
        }
    }
    ?>
</table>

<!-- Modal HTML -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="eventTitle"></h2>
        <p id="eventDescription"></p>
    </div>
</div>

<script>
    function showDescription(title, description) {
        document.getElementById('eventTitle').innerText = title;
        document.getElementById('eventDescription').innerText = description;
        document.getElementById('myModal').style.display = "block";
    }

    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName('close')[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<style>
    .calendar-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .prev {
        float: left;
    }

    .next {
        float: right;
    }

    .month-year {
        font-size: 24px;
        font-weight: bold;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
