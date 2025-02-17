<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Student;
use App\Models\Backend\Subcategory;
use App\Models\Teacher\Studymaterial;
use App\Models\Teacher\Studymaterialtype;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudyMaterialController extends Controller
{
	public function get_material_type()
	{
		$material_types = Studymaterialtype::all();

		$student_details = Student::where('email', Auth::user()->email)->first();
		$subcategory = Subcategory::where('id', $student_details->subcategory)->pluck('subcategory_name')->first();

		foreach ($material_types as $material_type) {
			$material_type->subcategory = $subcategory;
		}


		return response()->json(['material_types' => $material_types]);
	}
	public function get_study_material($type, $course_id)
	{
		$student_details = Student::where('email', Auth::user()->email)->first();

		$study_material = Studymaterial::where('type', $type)
			->where('course', $course_id)
			->where('course_category', $student_details->category)
			->where('course_subcategory', $student_details->subcategory)
			->select('subject', DB::raw('SUM(total_chapters) as total_chapters'))
			->groupBy('subject')
			->get();

		$formatted_study_material = [];

		foreach ($study_material as $item) {
			$formatted_study_material[] = [
				'subject' => $item->subject,
				'total_chapters' => $item->total_chapters,
			];
		}

		return response()->json(['study_material' => $formatted_study_material]);
	}

	public function get_study_material_chapters($subject, $course_id)
	{
		try {
			$student_details = Student::where('email', Auth::user()->email)->first();

			$study_materials = Studymaterial::join('studymaterialitems', 'studymaterialitems.studymaterial_id', 'studymaterials.id')
				->where('studymaterials.course', $course_id)
				->where('course_category', $student_details->category)
				->where('course_subcategory', $student_details->subcategory)
				->where('studymaterials.subject', $subject)
				->select('studymaterials.type as type', 'studymaterials.subject as subject', 'studymaterialitems.chapter as chapter', 'studymaterialitems.pdf as pdf')
				->get();

			if ($study_materials->isEmpty()) {
				return response()->json(["study_materials" => []]);
			}

			// Add a serial number with "Chapter" prefix to each chapter
			$study_materials->map(function ($item, $key) {
				$item->chapter = "Chapter " . ($key + 1) . ": " . $item->chapter;
				return $item;
			});

			// Assign chapter_name without "Chapter X: " prefix
			$study_materials->map(function ($item, $key) {
				// Strip "Chapter X: " prefix for chapter_name
				$item->chapter_name = trim(preg_replace('/^Chapter \d+: /', '', $item->chapter));
				return $item;
			});

			// Fetch dynamic type and subject values
			$type = Studymaterialtype::where('id', $study_materials->first()->type)->pluck('type')->first();
			$subject = $study_materials->first()->subject;

			$study_materials->transform(function ($study_material) {
				$study_material->pdf = asset('Study Material/' . $study_material->pdf);
				return $study_material;
			});

			$study_materials_response = [
				'type' => $type,
				'subject' => $subject,
				'study_materials' => $study_materials
			];

			return response()->json($study_materials_response);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
}
