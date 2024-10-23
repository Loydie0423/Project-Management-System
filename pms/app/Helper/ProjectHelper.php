<?php

namespace App\Helper;

use App\Models\ProjectCategory;
use Illuminate\Support\Str;

class ProjectHelper
{

    public function generateProjectCode(string $categoryName)
    {

        $projectInitial = $categoryName[0];
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