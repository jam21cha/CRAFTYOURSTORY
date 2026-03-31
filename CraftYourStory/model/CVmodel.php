<?php
 
class CVModel {
 
    public function processData(array $data): array {
        foreach (['name', 'jobtitle', 'email', 'phone', 'location', 'skills', 'education', 'photo'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = htmlspecialchars_decode(strip_tags(trim($data[$field])));
            }
        }
 
        if (!empty($data['experiences']) && is_array($data['experiences'])) {
            foreach ($data['experiences'] as &$exp) {
                foreach (['title', 'company', 'start', 'end', 'date', 'desc'] as $field) {
                    if (isset($exp[$field])) {
                        $exp[$field] = htmlspecialchars_decode(strip_tags(trim($exp[$field])));
                    }
                }
            }
            unset($exp);
        }
 
        return $data;
    }
}
?>
