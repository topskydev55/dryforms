<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProjectScopes\ProjectScopesIndex;
use App\Http\Requests\ProjectScopes\ProjectScopesStore;
use App\Http\Requests\ProjectScopes\ProjectScopesUpdate;

use App\Models\ProjectScope;
use App\Models\StandardScope;
use App\Models\DefaultScope;
use App\Models\ProjectArea;

use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectScopesController extends ApiController
{
	/**
     * @var ProjectScope
     */
    private $projectScope;

    /**
     * @var StandardScope
     */
    private $standardScope;

    /**
     * @var DefaultScope
     */
    private $defaultScope;

    /**
     * @var ProjectArea
     */
    private $projectArea;

    /**
     * ProjectScopesController constructor.
     *
     * @param ProjectArea $projectArea
     * @param ProjectScope $projectScope
     * @param StandardScope $standardScope
     * @param DefaultScope $defaultScope
     */
    public function __construct(ProjectScope $projectScope, StandardScope $standardScope, DefaultScope $defaultScope, ProjectArea $projectArea)
    {
    	$this->projectScope = $projectScope;
        $this->standardScope = $standardScope;
        $this->defaultScope = $defaultScope;
        $this->projectArea = $projectArea;
    }

	/**
     * @param ProjectScopesIndex $request
     *
     * @return JsonResponse
     */
    public function index(ProjectScopesIndex $request): JsonResponse
    {
    	if ($request->input('curPageNum') == 0) {
            $projectScopesPerArea = $this->projectScope
                ->with(['uom_info'])
                ->where('project_id', $request->input('project_id'))
                ->where('page', $request->get('curPageNum'));

            if ($projectScopesPerArea->count() == 0) {
                $standardScopes = $this->standardScope
                    ->where('page', $request->get('curPageNum'))
                    ->get()
                    ->toArray();
                foreach ($standardScopes as $key => $scope) {
                    $scope['project_id'] = $request->input('project_id');
                    $scope['standard_scope_edited'] = 0;

                    $this->projectScope->create($scope);
                }
            }

            $scopes = $projectScopesPerArea
                ->orderBy('no')
                ->get();

            return $this->respond([
                'misc_page_scopes' => $scopes
            ]);
        } else {
            $projectScopesPerArea = $this->projectScope
                ->with(['uom_info'])
                ->where('project_id', $request->input('project_id'))
                ->where('project_area_id', $request->input('project_area_id'))
                ->where('page', $request->get('curPageNum'));

            if ($projectScopesPerArea->count() == 0) {
                $standardScopes = $this->standardScope
                    ->where('page', $request->get('curPageNum'))
                    ->get()
                    ->toArray();
                foreach ($standardScopes as $key => $scope) {
                    $scope['project_id'] = $request->input('project_id');
                    $scope['project_area_id'] = $request->input('project_area_id');
                    $scope['standard_scope_edited'] = $scope['selected'] == 1 || $scope['service'] != null || $scope['is_header'] == 1 || $scope['qty'] != null || $scope['uom'] != null ? 1 : 0;

                    $this->projectScope->create($scope);
                }
            }

            $scopes = $projectScopesPerArea
                ->orderBy('no')
                ->get();
            $maxPage = $this->standardScope->max('page');

            return $this->respond([
                'cur_page_scopes' => $scopes,
                'max_page' => $maxPage
            ]);
        }		
    }

    /**
     * @param ProjectScopesUpdate $request
     *
     * @return JsonResponse
     */
    public function update(ProjectScopesUpdate $request): JsonResponse
    {
        $projectScope = $this->projectScope
            ->findOrFail($request->input('id'));
        $projectScope->update($request->validatedOnly());

        return $this->respond(['message' => 'Scope successfully updated', 'scope' => $projectScope]);
    }
}