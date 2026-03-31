<?php
require_once(__DIR__ . "/../model/CVModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $experiences = [];
    if (!empty($_POST['exp_title'])) {
        foreach ($_POST['exp_title'] as $i => $title) {
            $title   = trim($title);
            $company = trim($_POST['exp_company'][$i] ?? '');
            $start   = trim($_POST['exp_start'][$i]   ?? '');
            $end     = trim($_POST['exp_end'][$i]     ?? '');
            $desc    = trim($_POST['exp_desc'][$i]    ?? '');

            if ($title !== '' || $company !== '') {
                $experiences[] = [
                    'title'   => $title,
                    'company' => $company,
                    'start'   => $start,
                    'end'     => $end,
                    'date'    => trim("$start – $end", ' –'),
                    'desc'    => $desc,
                ];
            }
        }
    }

    $data = [
        "name"        => trim($_POST['name']      ?? ''),
        "jobtitle"    => trim($_POST['jobtitle']  ?? ''),
        "email"       => trim($_POST['email']     ?? ''),
        "phone"       => trim($_POST['phone']     ?? ''),
        "location"    => trim($_POST['location']  ?? ''),
        "skills"      => trim($_POST['skills']    ?? ''),
        "education"   => trim($_POST['education'] ?? ''),
        "experiences" => $experiences,
    ];

    $data['photo'] = '';
    $photo = $_FILES['photo'] ?? null;
    if ($photo && $photo['error'] === UPLOAD_ERR_OK && $photo['size'] > 0) {
        $uploadDir = __DIR__ . "/../assets/uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $safeName   = time() . '_' . basename($photo['name']);
        $uploadPath = $uploadDir . $safeName;
        if (move_uploaded_file($photo['tmp_name'], $uploadPath)) {
            $data['photo'] = $uploadPath;
        }
    }

    $cv     = new CVModel();
    $result = $cv->processData($data);

    include(__DIR__ . "/../view/displayInfo.php");
}
?>
