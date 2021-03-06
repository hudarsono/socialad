@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if ($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif
                    <form method="post" action="/keyword_stats">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="ad_id">Ad ID:</label>
                            <input type="text" class="form-control" id="ad_id" name="ad_id" value="{{ request()->input('ad_id')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="ad_id">Select Parameter:</label>
                            @foreach (array_chunk(param_list(), 4) as $chunk)
                            <div class="row">
                                @foreach($chunk as $param)
                                <div class="col-md-3">
                                    <input type="checkbox" name="params[]" value="{{ $param }}"  
                                        @if(!empty(request()->input('params')) && in_array($param, request()->input('params')))
                                            checked
                                        @endif
                                        > {{ action_type_humanize($param) }}
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="ad_id">Select Action:</label>
                            @foreach (array_chunk(action_list(), 4) as $chunk)
                            <div class="row">
                                @foreach($chunk as $action)
                                <div class="col-md-3">
                                    <input type="checkbox" name="actions[]" value="{{ $action }}"  
                                        @if(!empty(request()->input('actions')) && in_array($action, request()->input('actions')))
                                            checked
                                        @endif
                                        > {{ action_type_humanize($action) }}
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Get Report</button>
                    </form>

                    <hr>
    
                    @if (!empty($data))
                        <table id="keyword_stats" class="table table-striped table-responsive" width="100%">
                        <thead>
                        <tr>
                            <th>Interest</th>
                            @if (count(request()->input('params')) > 0)
                            @foreach (request()->input('params') as $param)
                                <th>{{ action_type_humanize($param) }}</th>
                            @endforeach
                            @endif
                            @if (count(request()->input('actions')) > 0)
                                @foreach (request()->input('actions') as $action)
                                    <th>{{ action_type_humanize($action) }}</th>
                                @endforeach
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['data'] as $interest)
                        <tr>
                            <td>{{ $interest['name'] }}</td>
                            @if (count(request()->input('params')) > 0)
                            @foreach (request()->input('params') as $param)
                                @if (in_array($param, ['cpc', 'spend','cpm','cpp']))
                                    <td>{{ '$'.round($interest[$param],2) }}</td>
                                @elseif ( $param == 'ctr')
                                    <td>{{ round($interest[$param]*100,2).'%' }}</td>
                                @else
                                    <td>{{ $interest[$param] }}</td>
                                @endif
                            @endforeach
                            @endif
                            @if (count(request()->input('actions')) > 0)
                                @foreach (request()->input('actions') as $action)
                                    <td>
                                        @if (isset($interest['actions']))
                                            @if ($action == 'cost/purchase')
                                                @if (isset($interest['spend']) && action_value('offsite_conversion.fb_pixel_purchase', $interest['actions']))
                                                    {{ '$'.(float)round($interest['spend']/action_value('offsite_conversion.fb_pixel_purchase', $interest['actions']),2) }}
                                                @endif
                                            @elseif ($action == 'cost/comment')
                                                @if (isset($interest['spend']) && action_value('comment', $interest['actions']))
                                                    {{ '$'.round($interest['spend']/action_value('comment', $interest['actions']),2) }}
                                                @endif
                                            @elseif ($action == 'cost/linkclick')
                                                @if (isset($interest['spend']) && action_value('link_click', $interest['actions']))
                                                    {{ '$'.round($interest['spend']/action_value('link_click', $interest['actions']),2) }}
                                                @endif
                                            @else
                                                @if (action_value($action, $interest['actions']))
                                                    {{ action_value($action, $interest['actions']) }}
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>

@endsection