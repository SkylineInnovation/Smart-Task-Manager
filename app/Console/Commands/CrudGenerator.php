<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:new {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'the new version of crud for flutter 3 and laravel 9';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // the name of the (({{ Model }}))
        $theModel = $this->argument('model');

        $Model = Str::singular(ucfirst($theModel)); // Student
        $model = Str::singular(strtolower($theModel)); // student
        // $Models = Str::plural(ucfirst($theModel)); // Students
        $models = Str::plural(strtolower($theModel)); // students
        // 
        // it contain some data
        $data = true;
        // all the ((column)) in the Model
        $theFillables = "";

        // The Import
        $import_trim_fillables = "";
        $import_fillables = "";

        // The Export
        // $export_fillables = "";
        $td_header = "";
        $td_data = "";

        $filter_div = "";
        $filter_public = "";
        $filter_select = "";
        $filter_where_in = "";
        $filter_clear = "";

        // 
        $AllResource = "";
        // for index
        $indexInputsThead = "";
        // for index
        $indexInputsTbody = "";
        // 
        // $Controller_Select_field = "";
        // 
        // $Controller_Select_field_compact = "";
        // 
        $Controller_store_update_data = "";
        // 
        $theUpdateImageController = "";
        // 
        $createField = "";
        // 
        $valedationErrorField = "";
        // 
        $editField = "";
        // 
        $theRelation = "";
        // 
        $viewField = "";
        // 
        $orderBy = "";
        // 
        $livewireSearch = "";
        $livewireShowColumn = "";
        $livewirePublic = "";
        $livewireResetInputFields = "";
        $livewireValidatedDate = "";
        $livewireCreate = "";
        $livewireEdit = "";
        $livewireUpdate = "";
        $livewireRelationship = "";
        $livewireRelationshipMount = "";

        // 
        $isInIndex = true;
        $isText = false;
        $isNumber = false;
        $isImage = false;
        $itHaveImage = false;
        $isSelect = false;

        $inMigration = "";
        $inLang = "";


        while ($data) {
            $fillable = $this->ask('The Value? (-0 hide-from-index, | (-1,phone,number,price,quantity), | (-2,image,logo) , | (-3,::)) (leave null to stop) ');

            if ($fillable == null) {
                $data = false;
            } else {

                $fillable = strtolower($fillable);

                $Fillable = Str::singular(ucfirst($fillable)); // Student
                $fillables = Str::plural(strtolower($fillable)); // students

                $isInIndex = true;
                $isText = false;
                $isNumber = false;
                $isImage = false;
                $isSelect = false;

                if (str_contains($fillable, '-0')) { // show in index
                    $isInIndex = false;
                    $fillable = str_replace('-0', '', $fillable);
                } else {
                    $isInIndex = true;
                }


                // the number stuff
                if (str_contains($fillable, '-1')) {
                    $fillable = str_replace('-1', '', $fillable);
                    $fillable = str_replace(' ', '', $fillable);

                    $isNumber = true;

                    $theFillables = $theFillables . "
                        '$fillable',";

                    $AllResource = $AllResource . "
                    '$fillable' => \$this->$fillable,";

                    $import_trim_fillables = $import_trim_fillables . "
                    $$fillable = trim(\$row['$fillable']);\n";

                    $import_fillables = $import_fillables . "
                    '$fillable' => $$fillable,\n";


                    $td_header = $td_header . "
                    <td>$fillable</td>\n";

                    $td_data = $td_data . "
                    <td>{{ \$$model->$fillable }}</td>\n";

                    // if (str_contains($fillable, 'price') || str_contains($fillable, 'Price')) {
                    //     $inMigration = $inMigration . "
                    //     \$table->double('$fillable')->nullable();\n";
                    // } else {
                    $inMigration = $inMigration . "
                        \$table->integer('$fillable')->nullable();\n";
                    // }

                    $createField = $createField . "
                        @include('inputs.create.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'livewire' => '$fillable',
                            'type' => 'number', 'step' => 1,
                            // 'required' => 'required', 
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ])\n";

                    $valedationErrorField = $valedationErrorField . "
                    @error('$fillable')
                        <span class='alert alert-danger btn'>{{ \$message }}</span>
                    @enderror\n";

                    // 

                    $editField = $editField . "
                        @include('inputs.edit.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'val' => $$model->$fillable,
                            'livewire' => '$fillable',
                            'type' => 'number', 'step' => 1,
                            // 'required' => 'required', 
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ])\n";

                    // 

                    $viewField = $viewField . " 
                        @include('inputs.show.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'val' => $$model->$fillable,
                            'livewire' => '$fillable',
                            // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ])\n";

                    // the image stuff
                } elseif (str_contains($fillable, '-2')) {
                    $fillable = str_replace('-2', '', $fillable);
                    $fillable = str_replace(' ', '', $fillable);

                    $isImage = true;

                    $theFillables = $theFillables . "
                        '$fillable',";

                    $AllResource = $AllResource . "
                        '$fillable' => \$this->$fillable != null ? asset(\$this->$fillable) : null,";

                    // $import_trim_fillables = $import_trim_fillables . "
                    //     $$fillable = trim(\$row['$fillable']);\n";

                    // $import_fillables = $import_fillables . "
                    //     '$fillable' => $$fillable,";

                    $td_header = $td_header . "
                    <td>$fillable</td>\n";

                    $td_data = $td_data . "
                    <td>{{ asset(\$$model->$fillable) }}</td>\n";

                    $inMigration = $inMigration . "
                        \$table->longText('$fillable')->nullable();\n";


                    $createField = $createField . "
                        @include('inputs.create.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'livewire' => '$fillable',
                            'type' => 'file', // 'required' => 'required',
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ])\n";

                    $valedationErrorField = $valedationErrorField . "
                    @error('$fillable')
                        <span class='alert alert-danger btn'>{{ \$message }}</span>
                    @enderror\n";
                    // 

                    $editField = $editField . "
                        @include('inputs.edit.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'val' => $$model->$fillable,
                            'livewire' => '$fillable',
                            'type' => 'file', // 'required' => 'required', 
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ])\n";

                    // 

                    $viewField = $viewField . "
                    <div class='col-12'>
                        <img src='{{ asset(\$$model->$fillable) }}' width='200px' height='150px'>
                    </div>\n";

                    $theUpdateImageController = $theUpdateImageController . "
                    if (\$request->has('$fillable')) {
                        \$theImageName_$fillable = '$model" . "_' . Str::random(25) . '.' . \$request->$fillable" . "->extension();
                        \$request->$fillable" . "->storeAs('$model', \$theImageName_$fillable);
                        \$theImageUrl_$fillable = 'images/$model/' . \$theImageName_$fillable;
                    } else {
                        \$theImageUrl_$fillable = $$model->$fillable;
                    }";

                    $Controller_store_update_data = $Controller_store_update_data . "
                    '$fillable' => \$theImageUrl_$fillable ?? '',";


                    // the relation stuff
                } elseif (str_contains($fillable, '-3') || str_contains($fillable, '::')) {
                    $fillable = str_replace('-3', '', $fillable);
                    $fillable = str_replace('::', '', $fillable);
                    $fillable = str_replace(' ', '', $fillable);

                    $isSelect = true;

                    $Fillable = Str::singular(ucfirst($fillable)); // Student
                    $fillables = Str::plural(strtolower($fillable)); // students

                    $theFillables = $theFillables . "
                    '$fillable" . "_id',";

                    $inMigration = $inMigration . "
                    \$table->foreignIdFor(App\Models\\$Fillable::class)->nullable();\n";

                    $AllResource = $AllResource . "
                    '$fillable' => new $Fillable" . "Resource(\$this->whenLoaded('$fillable')),";

                    // $import_trim_fillables = $import_trim_fillables . "
                    // $$fillable = trim(\$row['$fillable']);\n";

                    // $import_fillables = $import_fillables . "
                    // '$fillable' => $$fillable,";

                    $td_header = $td_header . "
                    <td>$fillable</td>";

                    $td_data = $td_data . "
                    <td>{{ \$$model->$fillable" . "->crud_name() }}</td>\n";

                    $filter_public = $filter_public . "
                    public \$filter_" . $fillables . "_id = [];\n";

                    $filter_select = $filter_select . "
                    public $" . "select_$fillable;
                    public function updatedSelect$Fillable(\$val)
                    {
                        \$this->filter_" . $fillables . "_id[] = \$val;
                    }\n\n";

                    $filter_where_in = $filter_where_in . "
                    if (\$this->filter_" . $fillables . "_id)
                        $" . $models . " = $" . $models . "->whereIn('$fillable" . "_id', \$this->filter_" . $fillables . "_id);
                    ";

                    $filter_clear = $filter_clear . "
                    $" . "this->filter_" . $fillables . "_id = [];\n";

                    $filter_div = $filter_div . "
                    <div class='form-group'>
                        <label for='" . $fillable . "-select'>{{ __('global.by_" . $fillables . "') }}</label>
                        <select id='" . $fillable . "-select' class='form-control' wire:model='select_" . $fillable . "'>
                            <option>Select " . $fillables . "</option>
                            @foreach ($" . $fillables . " as $" . $fillable . ")
                                <option value='{{ $" . $fillable . "->id }}'>{{ $" . $fillable . "->crud_name() }}</option>
                            @endforeach
                        </select>

                        @foreach ($" . $fillables . " as $" . $fillable . ")
                            @if (in_array($" . $fillable . "->id, $" . "filter_" . $fillables . "_id))
                                <div class='form-check form-check-inline'>
                                    <input wire:model='filter_" . $fillables . "_id' class='form-check-input' type='checkbox'
                                        value='{{ $" . $fillable . "->id }}' id='filter-" . $fillables . "-id-{{ $" . $fillable . "->id }}'>
                                    <label class='form-check-label' for='filter-" . $fillables . "-id-{{ $" . $fillable . "->id }}'>
                                        {{ $" . $fillable . "->crud_name() }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>\n";

                    // $Controller_Select_field = $Controller_Select_field . "
                    // \$$fillables = \App\Models\\$Fillable::where('show', 1)->orderBy('sort')->get();\n";

                    // $Controller_Select_field_compact = $Controller_Select_field_compact . "
                    // '$fillables' => \$$fillables,";

                    // // // // // // // //
                    $createField = $createField . "
                    @include('inputs.create.select', [
                        'label' => '$model.$fillable', 'name' => '$model.$fillable" . "_id', 
                        'arr' => \$$fillables,
                        'livewire' => '$fillable" . "_id',
                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                    ])\n";

                    $valedationErrorField = $valedationErrorField . "
                    @error('$fillable')
                        <span class='alert alert-danger btn'>{{ \$message }}</span>
                    @enderror\n";

                    $editField = $editField . "
                    @include('inputs.edit.select', [
                        'label' => '$model.$fillable', 'name' => '$model.$fillable" . "_id', 
                        'arr' => \$$fillables,
                        'livewire' => '$fillable" . "_id',
                        'val' => $$model->$fillable" . "_id,
                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                    ])\n";

                    $viewField = $viewField . "
                    @include('inputs.show.input', [
                        'label' => '$model.$fillable',
                        'val' => $$model->$fillable" . "->crud_name(),
                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                    ])\n";

                    $theRelation = $theRelation . "
                    public function $fillable() {
                        return \$this->belongsTo($Fillable::class);
                    }\n\n";

                    $Controller_store_update_data = $Controller_store_update_data . "
                    '$fillable" . "_id' => \$request->$fillable" . "_id,";


                    $livewireRelationship = $livewireRelationship . "
                        public \$$fillables = [];\n";

                    $livewireRelationshipMount = $livewireRelationshipMount . "
                        \$this->$fillables = \App\Models\\$Fillable::where('show', 1)->orderBy('sort')->get();\n";

                    // // // // // // // // 
                    // the stander stuff
                } else {
                    $fillable = str_replace(' ', '', $fillable);

                    $isText = true;

                    $theFillables = $theFillables . "
                        '$fillable',";

                    $inMigration = $inMigration . "
                        \$table->longText('$fillable')->nullable();\n";

                    $AllResource = $AllResource . "
                        '$fillable' => \$this->$fillable,";

                    $import_trim_fillables = $import_trim_fillables . "
                        $$fillable = trim(\$row['$fillable']);\n";

                    $import_fillables = $import_fillables . "
                        '$fillable' => $$fillable,";

                    $td_header = $td_header . "
                    <td>$fillable</td>\n";

                    $td_data = $td_data . "
                    <td>{{ \$$model->$fillable }}</td>\n";


                    $createField = $createField .
                        "@include('inputs.create.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'livewire' => '$fillable',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required', 
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ]) \n ";

                    $valedationErrorField = $valedationErrorField . "
                    @error('$fillable')
                        <span class='alert alert-danger btn'>{{ \$message }}</span>
                    @enderror\n";

                    $editField = $editField .
                        "@include('inputs.edit.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'val' => $$model->$fillable,
                            'livewire' => '$fillable',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required', 
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ]) \n ";

                    $viewField = $viewField . " 
                        @include('inputs.show.input', [
                            'label' => '$model.$fillable', 'name' => '$model.$fillable', 
                            'val' => $$model->$fillable,
                            'livewire' => '$fillable',
                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                        ]) \n ";

                    $Controller_store_update_data = $Controller_store_update_data . "
                        '$fillable' => \$request->$fillable,";
                }

                $inLang = $inLang . "
                    '$fillable' => '$fillable',\n";



                if ($isInIndex) {
                    //  for Index HR
                    if (!$isSelect) {
                        $indexInputsThead = $indexInputsThead . "
                            @if (\$showColumn['$fillable'])
                                <td>{{ __('$model.$fillable') }}</td>
                            @endif\n";
                    } else {
                        $indexInputsThead = $indexInputsThead . "
                            @if (\$showColumn['$fillable" . "_id'])
                                <td>{{ __('$model.$fillable') }}</td>
                            @endif\n";
                    }

                    if ($isText || $isNumber) {
                        //  for Index TD
                        $indexInputsTbody = $indexInputsTbody . "
                        @if (\$showColumn['$fillable'])
                            <td> {{ $$model->$fillable }} </td>
                        @endif\n";
                    } elseif ($isImage) {
                        //  for Index TD
                        $indexInputsTbody = $indexInputsTbody . "
                        @if (\$showColumn['$fillable'])
                            <td> 
                                @if ($$model->$fillable)
                                    <img src='{{ asset(\$$model->$fillable) }}' width='75px' height='75px'> 
                                @else
                                    <p>{{ __('$model.$fillable') }}</p>
                                @endif
                            </td>
                        @endif\n";
                    } elseif ($isSelect) {
                        $indexInputsTbody = $indexInputsTbody . "
                        @if (\$showColumn['$fillable" . "_id'])
                            <td>
                                @if ($$model->$fillable)
                                    {{ $$model->$fillable" . "->crud_name() }}
                                @endif
                            </td>
                        @endif\n";
                    }
                }


                if (!$isSelect) {
                    $orderBy = $orderBy . "
                        <option value='$fillable'>{{ __('$model.$fillable') }}</option>
                    ";

                    $livewireSearch = $livewireSearch . "
                            \$q->orWhereSearch('$fillable', \$search);";

                    $livewireShowColumn = $livewireShowColumn . "
                    '$fillable' => true,";

                    $livewirePublic = $livewirePublic . ", $$fillable";

                    $livewireResetInputFields = $livewireResetInputFields . "
                    \$this->$fillable = '';";

                    $livewireValidatedDate = $livewireValidatedDate . "
                    '$fillable' => 'required',";

                    $livewireCreate = $livewireCreate . "
                    '$fillable' => \$this->$fillable,";

                    $livewireEdit = $livewireEdit . "
                    \$this->$fillable = $" . $model . "->$fillable;";

                    $livewireUpdate = $livewireUpdate . "
                    '$fillable' => \$this->$fillable,";
                } else {
                    $orderBy = $orderBy . "
                        <option value='$fillable" . "_id'>{{ __('$model.$fillable') }}</option>
                    ";

                    $livewireSearch = $livewireSearch . "
                            // \$q->orWhere('$fillable" . "_id', 'like', \"%\$search%\");";

                    $livewireShowColumn = $livewireShowColumn . "
                    '$fillable" . "_id' => true,";

                    $livewirePublic = $livewirePublic . ", $$fillable" . "_id";

                    $livewireResetInputFields = $livewireResetInputFields . "
                    \$this->$fillable" . "_id = null;";

                    $livewireValidatedDate = $livewireValidatedDate . "
                    '$fillable" . "_id' => 'required',";

                    $livewireCreate = $livewireCreate . "
                    '$fillable" . "_id' => \$this->$fillable" . "_id,";

                    $livewireEdit = $livewireEdit . "
                    \$this->$fillable" . "_id = $" . $model . "->$fillable" . "_id;";

                    $livewireUpdate = $livewireUpdate . "
                    '$fillable" . "_id' => \$this->$fillable" . "_id,";
                }
            }
        }


        $this->model($Model, $theFillables, $theRelation, $livewireSearch);

        $this->controller($Model,);
        $this->migrations($Model, $inMigration);

        $this->resources($Model, $AllResource);
        $this->lang($model, $inLang);

        $this->livewireHome($models, $model);
        $this->livewireIndex($model, $indexInputsThead, $indexInputsTbody);
        $this->livewireTop($model, $orderBy, $filter_div);
        $this->livewireModal($model, $createField, $editField, $valedationErrorField);


        $this->livewireIndexController(
            $Model,
            $livewireShowColumn,
            $livewirePublic,
            $livewireResetInputFields,
            $livewireValidatedDate,
            $livewireCreate,
            $livewireEdit,
            $livewireUpdate,
            $livewireRelationship,
            $livewireRelationshipMount,
            $filter_public,
            $filter_select,
            $filter_where_in,
            $filter_clear
        );

        $this->importData($model, $Model, $import_trim_fillables, $import_fillables);

        $this->exportData($model, $Model, $td_header, $td_data);


        File::append(
            base_path('routes/web.php'),
            "\n" .
                "// the full routes for $models\n" .
                "Route::middleware('permission:index-$model')->get('$models', [App\Http\Controllers\\{$Model}Controller::class, 'livewireIndex'])->name('$model.index');\n" .
                "Route::middleware('permission:restore-$model')->get('trash/$models', [App\Http\Controllers\\{$Model}Controller::class, 'livewireDeletedIndex'])->name('$model.index.trash');\n" .

                "Route::get('export/$models', [App\Http\Controllers\\{$Model}Controller::class, 'exportFullData'])->name('$model.export');\n" .
                "Route::post('import/$models', [App\Http\Controllers\\{$Model}Controller::class, 'importData'])->name('$model.import');\n\n"
        );


        File::append(
            base_path('resources/views/layouts/side.blade.php'),
            "
@permission('index-$model')
    <li>
        <a class='slide-item' href='{{ route('$model.index') }}'>
            <span>{{ __('global.$models') }}</span>
        </a>
    </li>
@endpermission\n\n"
        );

        File::append(
            base_path('resources/views/layouts/deleted-side.blade.php'),
            "
@permission('restore-$model')
    <li>
        <a class='slide-item' href='{{ route('$model.index.trash') }}'>
            <span>{{ __('global.$models') }}</span>
        </a>
    </li>
@endpermission\n\n"
        );
    }



    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($Model, $fillables, $theRelation, $livewireSearch)
    {
        $modelTemplate = str_replace(
            [
                '{{Model}}',
                '{{fillables}}',
                '{{theRelation}}',
                '{{livewireSearch}}',
            ],
            [
                $Model,
                $fillables,
                $theRelation,
                $livewireSearch,
            ],
            $this->getStub('Model')
        );

        file_put_contents(app_path("Models/{$Model}.php"), $modelTemplate);
    }

    protected function controller($Model)
    {

        $controllerTemplate = str_replace(
            [
                '{{Model}}',
                '{{models}}',
                '{{model}}',
            ],
            [
                $Model,
                strtolower(Str::plural($Model)),
                strtolower($Model),
            ],
            $this->getStub('Controller'),
        );

        file_put_contents(app_path("/Http/Controllers/{$Model}Controller.php"), $controllerTemplate);
    }

    protected function migrations($name, $theFullDatabase)
    {
        $requestTemplate = str_replace(
            [
                '{{Models}}',
                '{{models}}',
                '{{theFullDatabase}}',
            ],
            [
                Str::plural(ucfirst($name)),
                strtolower(Str::plural($name)),
                $theFullDatabase,
            ],
            $this->getStub('Migration')
        );

        if (!file_exists($path = base_path('database/migrations/'))) mkdir($path, 0777, true);
        file_put_contents(base_path("database/migrations/" . str_replace(['-', ' ', ':'], ['_', '_', ''], \Carbon\Carbon::now()->toDateTimeString()) . "_create_" . Str::plural(strtolower($name)) . "_table.php"), $requestTemplate);
    }


    protected function resources($name, $AllResource)
    {
        $requestTemplate = str_replace(
            [
                '{{Model}}',
                '{{model}}',
                '{{AllResource}}',
            ],
            [
                $name,
                strtolower(Str::singular($name)),
                $AllResource,
            ],
            $this->getStub('Resource')
        );

        if (!file_exists($path = app_path('Http/Resources'))) mkdir($path, 0777, true);
        file_put_contents(app_path("Http/Resources/" . ucfirst($name) . "Resource.php"), $requestTemplate);
    }
    // 
    protected function lang($name, $inLang)
    {
        $requestTemplate = str_replace(
            [
                '{{lang}}',
            ],
            [
                $inLang,
            ],
            $this->getStub('lang/ar')
        );
        if (!file_exists($path = base_path('resources/lang/ar/'))) mkdir($path, 0777, true);
        file_put_contents(base_path("resources/lang/ar/" . strtolower($name) . ".php"), $requestTemplate);

        $requestTemplate = str_replace(
            [
                '{{lang}}',
            ],
            [
                $inLang,
            ],
            $this->getStub('lang/ar')
        );
        if (!file_exists($path = base_path('resources/lang/en/'))) mkdir($path, 0777, true);
        file_put_contents(base_path("resources/lang/en/" . strtolower($name) . ".php"), $requestTemplate);
    }
    // 
    // 
    // 
    protected function livewireHome($models, $model)
    {
        $requestTemplate = str_replace(
            [
                '{{models}}',
                '{{model}}',
            ],
            [
                $models,
                $model,
            ],
            $this->getStub('pages/livewire-home')
        );

        if (!file_exists($path = base_path("resources/views/pages/crud/$model"))) mkdir($path, 0777, true);
        file_put_contents(base_path("resources/views/pages/crud/{$model}/{$model}-home.blade.php"), $requestTemplate);
    }

    protected function livewireIndex($model, $inputsThead, $inputsTbody,)
    {
        $requestTemplate = str_replace(
            [
                '{{model}}',
                '{{Model}}',
                '{{models}}',
                '{{Models}}',
                '{{inputsThead}}',
                '{{inputsTbody}}',
            ],
            [
                Str::singular(strtolower($model)),
                Str::singular(ucfirst($model)),
                Str::plural(strtolower($model)),
                Str::plural(ucfirst($model)),
                $inputsThead,
                $inputsTbody,
            ],
            $this->getStub('pages/livewire-index')
        );

        if (!file_exists($path = base_path("resources/views/livewire/{$model}/"))) mkdir($path, 0777, true);
        file_put_contents(base_path("resources/views/livewire/{$model}/{$model}-index.blade.php"), $requestTemplate);
    }

    protected function livewireTop($model, $orderBy, $filter_div)
    {
        $requestTemplate = str_replace(
            [
                '{{model}}',
                '{{orderBy}}',
                '{{filter_div}}',
            ],
            [
                $model,
                $orderBy,
                $filter_div,
            ],
            $this->getStub('pages/livewire-top')
        );

        if (!file_exists($path = base_path("resources/views/livewire/{$model}/"))) mkdir($path, 0777, true);
        file_put_contents(base_path("resources/views/livewire/{$model}/{$model}-top.blade.php"), $requestTemplate);
    }

    protected function livewireModal($model, $createInput, $editInput, $valedationErrorField)
    {
        $requestTemplate = str_replace(
            [
                '{{model}}',
                '{{createInput}}',
                '{{editInput}}',
                '{{valedationErrorField}}'
            ],
            [
                $model,
                $createInput,
                $editInput,
                $valedationErrorField,
            ],
            $this->getStub('pages/livewire-modal')
        );

        if (!file_exists($path = base_path("resources/views/livewire/{$model}/"))) mkdir($path, 0777, true);
        file_put_contents(base_path("resources/views/livewire/{$model}/{$model}-create-modal.blade.php"), $requestTemplate);
    }

    protected function livewireIndexController($Model, $livewireShowColumn, $livewirePublic, $livewireResetInputFields, $livewireValidatedDate, $livewireCreate, $livewireEdit, $livewireUpdate, $livewireRelationship, $livewireRelationshipMount, $filter_public, $filter_select, $filter_where_in, $filter_clear)
    {
        $controllerTemplate = str_replace(
            [
                '{{model}}',
                '{{Model}}',
                '{{models}}',
                '{{Models}}',
                '{{livewireShowColumn}}',
                '{{livewirePublic}}',
                '{{livewireResetInputFields}}',
                '{{livewireValidatedDate}}',
                '{{livewireCreate}}',
                '{{livewireEdit}}',
                '{{livewireUpdate}}',
                '{{livewireRelationship}}',
                '{{livewireRelationshipMount}}',
                '{{filter_public}}',
                '{{filter_select}}',
                '{{filter_where_in}}',
                '{{filter_clear}}',
            ],
            [
                Str::singular(strtolower($Model)),
                Str::singular(ucfirst($Model)),
                Str::plural(strtolower($Model)),
                Str::plural(ucfirst($Model)),

                $livewireShowColumn,
                $livewirePublic,
                $livewireResetInputFields,
                $livewireValidatedDate,
                $livewireCreate,
                $livewireEdit,
                $livewireUpdate,
                $livewireRelationship,
                $livewireRelationshipMount,
                $filter_public,
                $filter_select,
                $filter_where_in,
                $filter_clear,
            ],
            $this->getStub('livewire-Controller-Index')
        );

        if (!file_exists($path = app_path("/Http/Livewire/" . $Model . "/"))) mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Livewire/" . $Model . "/" . ucfirst(strtolower($Model)) . "Index.php"), $controllerTemplate);
    }


    // 
    // 
    // 

    protected function importData($model, $Model, $import_trim_fillables, $import_fillables)
    {
        $importTemplate = str_replace(
            [
                '{{model}}',
                '{{Model}}',
                '{{import_trim_fillables}}',
                '{{import_fillables}}',
            ],
            // '{{import_create_fillables}}',
            // '{{import_update_fillables}}',
            [
                $model,
                $Model,
                $import_trim_fillables,
                $import_fillables,
            ],
            // $import_create_fillables,
            // $import_update_fillables,
            $this->getStub('excel/import-data')
        );

        if (!file_exists($path = app_path("Imports/" . $Model . "/"))) mkdir($path, 0777, true);
        file_put_contents(app_path("Imports/$Model/Full{$Model}sImport.php"), $importTemplate);
    }

    protected function exportData($model, $Model, $td_header, $td_data)
    {
        $exportTemplate = str_replace(
            [
                '{{model}}',
                '{{Model}}',
            ],
            // '{{export_fillables}}',
            [
                $model,
                $Model,
            ],
            // $export_fillables,
            $this->getStub('excel/export-data')
        );

        if (!file_exists($path = app_path("Exports/" . $Model . "/"))) mkdir($path, 0777, true);
        file_put_contents(app_path("Exports/$Model/Full{$Model}sExport.php"), $exportTemplate);

        // export.{{model}}.{{model}}
        $exportTableTemplate = str_replace(
            [
                '{{model}}',
                '{{td_header}}',
                '{{td_data}}',
            ],
            [
                $model,
                $td_header,
                $td_data,
            ],
            $this->getStub('excel/export-table')
        );

        if (!file_exists($path = base_path("resources/views/export/" . ucfirst(strtolower($Model)) . "/"))) mkdir($path, 0777, true);
        file_put_contents(base_path("resources/views/export/{$model}/{$model}-export.blade.php"), $exportTableTemplate);
    }
}
