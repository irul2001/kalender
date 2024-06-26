<h2>Tambah Jadwal</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('calendar/add'); ?>
    <label for="date">Tanggal</label>
    <input type="date" name="date"><br>

    <label for="event">Acara</label>
    <input type="text" name="event"><br>

    <label for="description">Deskripsi</label>
    <textarea name="description"></textarea><br>

    <input type="submit" name="submit" value="Tambahkan Jadwal">
</form>
