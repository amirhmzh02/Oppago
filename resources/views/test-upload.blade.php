<form method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="test_file">
    <button type="submit">Upload Test</button>
</form>