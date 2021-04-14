<?php
ini_set('open_basedir', __DIR__);
include('functions.php');

$message = "";
$error = "";
if(!empty($_POST['researcher_id'])) {
    if(validateResearcherId($_POST['researcher_id'])) {
        $researcher_folder = __DIR__ . '/' . basename($_POST['researcher_id']);
        if(file_exists($researcher_folder)) {
            $error = 'This researcher already exists.';
        } else {
            mkdir($researcher_folder, 0770);
            $message = "Successfully added researcher <strong>" . $_POST['researcher_id'] . "<strong>.";
        }
    } else {
        $error = 'The researcher ID must not contain these characters: <code>/ \\ .</code>';
    }


}

function validateResearcherId($rid) {
    return !preg_match('/[\/\\\.]/', $rid);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Smartriqs: Create new a researcher</title>
    <style type="text/css">
        * { font-family: "Fira Sans", sans-serif; }
    </style>
</head>
<body>
    <?php if($error): ?>
    <div style="width: 100%; padding: 10px; background-color: #D2564A; color: #fff;">
        <strong>Error:</strong> <?php echo $error ?>
    </div>
    <?php endif; ?>
     <?php if($message): ?>
    <div style="width: 100%; padding: 10px; background-color: #36C64E; color: #fff;">
        <strong>Message:</strong> <?php echo $message ?>
    </div>
    <?php endif; ?>
    <h1>Create a new researcher</h1>
    <form method="POST" action="create_researcher.php">
        <table style="border: 0;">
            <tr><td><label for="researcher_id">Researcher ID: </label></td><td><input id="researcher_id" name="researcher_id" type="text" required value="<?php echo uniqid() ?>"></td></tr>
            <tr><td colspan="2"><input type="submit" value="Create"></td></tr>
        </table>
    </form>
</body>
</html>
