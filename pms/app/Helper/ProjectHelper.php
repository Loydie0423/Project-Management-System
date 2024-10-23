<?php

namespace App\Helper;

use App\Models\ProjectCategory;
use Illuminate\Support\Str;

class ProjectHelper
{

    public function generateProjectCode(string $categoryName)
    {
        $projectInitial = '';
        for ($i = 0; $i <= (strlen($categoryName) - 1); $i++) {
            if ($i == 0) {
                $projectInitial .= $categoryName[0];
            }

            if (in_array($categoryName[$i], [' ', " "])) {
                $projectInitial .= $categoryName[($i + 1)] ?? '';
            }
        }
        $category = ProjectCategory::where('name', $categoryName)->first();
        $categoryId = (int) $category->id + 1;
        $projectCode = $projectInitial . "-" . $this->generateUniqueCode($categoryId);
        return $projectCode;
    }

    public function generateUniqueCode(int $categoryId)
    {
        $generatedCode = null;
        switch ($categoryId) {
            case ($categoryId < 9):
                $generatedCode = (string) '000' . $categoryId;
                break;
            case ($categoryId > 9):
                $generatedCode = (string) '00' . $categoryId;
                break;
            case ($categoryId > 99):
                $generatedCode = (string) '0' . $categoryId;
                break;
            default:
                $generatedCode = Str::uuid();
        }

        return $generatedCode;
    }


}