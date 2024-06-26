<!-- edit.php -->
<h2>Edit Jadwal</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('calendar/edit/' . $schedule['id']); ?>
    <label for="date">Tanggal</label>
    <input type="date" name="date" value="<?= $schedule['date']; ?>"><br>

    <label for="event">Acara</label>
    <input type="text" name="event" value="<?= $schedule['event']; ?>"><br>

    <label for="description">Deskripsi</label>
    <textarea name="description"><?= $schedule['description']; ?></textarea><br>

    <input type="submit" name="submit" value="Update Jadwal">
</form>
