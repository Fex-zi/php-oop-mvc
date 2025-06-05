<!DOCTYPE html>
<html>
<head>
    <title>File Upload Test</title>
</head>
<body>
    <h2>File Upload Test</h2>
    
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES)): ?>
        <?php
        header('Content-Type: application/json');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        try {
            //$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/../repo/images/maps/';
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/images/';
            
            // Test directory permissions first
            $tests = [
                'images_dir_exists' => is_dir($uploadDir),
                'images_dir_writable' => is_writable($uploadDir),
                'images_path' => $uploadDir
            ];
            
            if (!$tests['images_dir_writable']) {
                throw new Exception('Images directory not writable');
            }
            
            $results = [];
            
            foreach ($_FILES as $fieldName => $file) {
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $filename = basename($file['name']);
                    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
                    $targetPath = $uploadDir . $filename;
                    
                    // Handle duplicates
                    $counter = 1;
                    $originalFilename = $filename;
                    while (file_exists($targetPath)) {
                        $pathinfo = pathinfo($originalFilename);
                        $filename = $pathinfo['filename'] . '_' . $counter . '.' . $pathinfo['extension'];
                        $targetPath = $uploadDir . $filename;
                        $counter++;
                    }
                    
                    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                        $results[$fieldName] = [
                            'success' => true,
                            'filename' => $filename,
                            'path' => $targetPath,
                            'size' => $file['size']
                        ];
                    } else {
                        $results[$fieldName] = [
                            'success' => false,
                            'error' => 'Failed to move uploaded file'
                        ];
                    }
                } else {
                    $errors = [
                        UPLOAD_ERR_INI_SIZE => 'File too large (server limit)',
                        UPLOAD_ERR_FORM_SIZE => 'File too large (form limit)', 
                        UPLOAD_ERR_PARTIAL => 'Upload interrupted',
                        UPLOAD_ERR_NO_TMP_DIR => 'No temp directory',
                        UPLOAD_ERR_CANT_WRITE => 'Cannot write to disk',
                        UPLOAD_ERR_EXTENSION => 'Upload blocked by extension'
                    ];
                    $results[$fieldName] = [
                        'success' => false,
                        'error' => $errors[$file['error']] ?? 'Upload failed'
                    ];
                }
            }
            
            echo json_encode([
                'success' => true, 
                'message' => 'Upload test completed',
                'tests' => $tests,
                'results' => $results
            ]);
            
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
        ?>
    <?php else: ?>
        
        <!-- Show upload form if not a POST request -->
        <form method="POST" enctype="multipart/form-data">
            <p>
                <label>Test Image Upload:</label><br>
                <input type="file" name="test_image" accept="image/*" required>
            </p>
            <p>
                <label>Test Icon Upload:</label><br>
                <input type="file" name="test_icon" accept="image/*">
            </p>
            <p>
                <button type="submit">Upload Test Files</button>
            </p>
        </form>
        
        <h3>Directory Status:</h3>
        <?php
        $imageDir = $_SERVER['DOCUMENT_ROOT'] . '/images/';
        $iconDir = $_SERVER['DOCUMENT_ROOT'] . '/images/icons/';

        
        
        //$iconDir = $_SERVER['DOCUMENT_ROOT'] . '/../repo/images/maps/';


        
        echo "<p><strong>Images Dir:</strong> " . $imageDir . "</p>";
        echo "<p><strong>Exists:</strong> " . (is_dir($imageDir) ? 'Yes' : 'No') . "</p>";
        echo "<p><strong>Writable:</strong> " . (is_writable($imageDir) ? 'Yes' : 'No') . "</p>";
        
        echo "<p><strong>Icons Dir:</strong> " . $iconDir . "</p>";
        echo "<p><strong>Exists:</strong> " . (is_dir($iconDir) ? 'Yes' : 'No') . "</p>";
        echo "<p><strong>Writable:</strong> " . (is_writable($iconDir) ? 'Yes' : 'No') . "</p>";
        ?>
        
    <?php endif; ?>
</body>
</html>
