<section class="col-lg-12 connectedSortable">
    <div class="box box-default">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">
                {{ trans('todo_list.title') }}
            </h3>

            <div class="box-tools pull-right">
                <!--
                <ul class="pagination pagination-sm inline">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
                -->
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
        {{ trans('todo_list.nothing_todo') }}
        <!--
		<ul class="todo-list">

			<li>
                <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                <input type="checkbox" value="">
                <span class="text">Design a nice theme</span>
                <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>
            <li>
                <span class="handle">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                </span>
                <input type="checkbox" value="">
                <span class="text">Make the theme responsive</span>
                <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>
            <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                <input type="checkbox" value="">
                <span class="text">Let theme shine like a star</span>
                <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>
            <li>
                <span class="handle">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                </span>
                <input type="checkbox" value="">
                <span class="text">Let theme shine like a star</span>
                <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>
            <li>
                <span class="handle">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                </span>
                <input type="checkbox" value="">
                <span class="text">Check your messages and notifications</span>
                <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>
            <li>
                <span class="handle">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                </span>
                <input type="checkbox" value="">
                <span class="text">Let theme shine like a star</span>
                <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>

        </ul>
		-->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            {{--
            <button type="button" class="btn btn-default pull-right">
                <i class="fa fa-plus"></i>&nbsp;{{ trans('app.add_new') }}
            </button>
            --}}
        </div>
    </div>
</section>
