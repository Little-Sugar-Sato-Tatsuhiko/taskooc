<div>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid" x-data="{show:false,task_name:'undefined'}">
            <a class="navbar-brand" href="#">
                <div x-show="show">
                    <input class="form-control me-2" placeholder="タスク名" x-model="task_name" x-on:blur="show=false">
                </div>
                <div x-show="!show" @click="show = !show" x-text="task_name">
                    タスク名
                </div>
            </a>
        </div>
    </nav>
    <div class="row">
        <span class="d-none" id="diagram-data">{{$diagram->diagram}}</span>
        <div class="col-3">
            <div class="card task-list">
                <!-- <div class="card-header">
                        <div class="card-title">タスク</div>
                    </div> -->
                <div class="card-body">
                    <div>
                        @livewire('task-list-component')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            @livewire('diagram-area-component')
        </div>
    </div>
</div>