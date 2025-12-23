<?php
/**
 * Grading Functions for Marksheet System
 */

/**
 * Calculate percentage from obtained and maximum marks
 */
function calculatePercentage($obtained, $maximum) {
    if ($maximum <= 0) {
        return 0;
    }
    return round(($obtained / $maximum) * 100, 2);
}

/**
 * Get grade based on percentage
 */
function getGrade($percentage) {
    if ($percentage >= 80) {
        return [
            'grade' => 'A',
            'description' => 'Excellent'
        ];
    } elseif ($percentage >= 70) {
        return [
            'grade' => 'B',
            'description' => 'Very Good'
        ];
    } elseif ($percentage >= 60) {
        return [
            'grade' => 'C',
            'description' => 'Good'
        ];
    } elseif ($percentage >= 50) {
        return [
            'grade' => 'D',
            'description' => 'Satisfactory'
        ];
    } else {
        return [
            'grade' => 'F',
            'description' => 'Needs Improvement'
        ];
    }
}

/**
 * Calculate all marksheet data including percentages and grades
 */
function calculateMarksheetData($data) {
    // Calculate individual percentages
    $termOnePercentage = calculatePercentage($data['term_one_obtained_marks'], $data['term_one_max_marks']);
    $termTwoPercentage = calculatePercentage($data['term_two_obtained_marks'], $data['term_two_max_marks']);
    $termThreePercentage = calculatePercentage($data['term_three_obtained_marks'], $data['term_three_max_marks']);
    $projectWorkPercentage = calculatePercentage($data['project_work_obtained_marks'], $data['project_work_max_marks']);
    $assignmentPercentage = calculatePercentage($data['assignment_obtained_marks'], $data['assignment_max_marks']);
    $caseStudyPercentage = calculatePercentage($data['case_study_obtained_marks'], $data['case_study_max_marks']);
    
    // Calculate totals
    $totalObtained = $data['term_one_obtained_marks'] + $data['term_two_obtained_marks'] + 
                    $data['term_three_obtained_marks'] + $data['project_work_obtained_marks'] + 
                    $data['assignment_obtained_marks'] + $data['case_study_obtained_marks'];
    
    $totalMaximum = $data['term_one_max_marks'] + $data['term_two_max_marks'] + 
                   $data['term_three_max_marks'] + $data['project_work_max_marks'] + 
                   $data['assignment_max_marks'] + $data['case_study_max_marks'];
    
    $overallPercentage = calculatePercentage($totalObtained, $totalMaximum);
    
    // Get grade
    $gradeInfo = getGrade($overallPercentage);
    
    // Return updated data
    return [
        'term_one_percentage' => $termOnePercentage,
        'term_two_percentage' => $termTwoPercentage,
        'term_three_percentage' => $termThreePercentage,
        'project_work_percentage' => $projectWorkPercentage,
        'assignment_percentage' => $assignmentPercentage,
        'case_study_percentage' => $caseStudyPercentage,
        'total_obtained_marks' => $totalObtained,
        'total_max_marks' => $totalMaximum,
        'overall_percentage' => $overallPercentage,
        'grade' => $gradeInfo['grade'],
        'grade_description' => $gradeInfo['description']
    ];
}

/**
 * Format percentage for display
 */
function formatPercentage($percentage) {
    return number_format($percentage, 2) . '%';
}

/**
 * Get grade color class for display
 */
function getGradeColorClass($grade) {
    switch ($grade) {
        case 'A':
            return 'text-success'; // Green
        case 'B':
            return 'text-primary'; // Blue
        case 'C':
            return 'text-info'; // Light blue
        case 'D':
            return 'text-warning'; // Yellow
        case 'F':
            return 'text-danger'; // Red
        default:
            return 'text-muted'; // Gray
    }
}

/**
 * Generate course short name from full course name
 * Example: "Infection Control Nurse - 3.0" → "ICN-3.0"
 * Example: "Computer Science" → "CS"
 */
function getCourseShortName($courseName) {
    // Check if course name has a dash with version (e.g., "Infection Control Nurse - 3.0")
    // Try multiple dash formats
    $separators = [' - ', ' – ', '-', '–'];
    $hasSeparator = false;
    $mainName = $courseName;
    $version = '';
    
    foreach ($separators as $sep) {
        if (strpos($courseName, $sep) !== false) {
            $parts = explode($sep, $courseName, 2);
            $mainName = trim($parts[0]);
            if (isset($parts[1])) {
                $version = trim($parts[1]);
            }
            $hasSeparator = true;
            break;
        }
    }
    
    // Get initials from main name
    $words = explode(' ', $mainName);
    $shortName = '';
    foreach ($words as $word) {
        if (!empty($word)) {
            $shortName .= strtoupper(substr($word, 0, 1));
        }
    }
    
    // Return with version if exists
    if ($hasSeparator && !empty($version)) {
        return $shortName . '-' . $version;
    } else {
        return $shortName;
    }
}
?>

