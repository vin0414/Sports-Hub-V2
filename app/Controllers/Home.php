<?php

namespace App\Controllers;
use App\Libraries\Hash;

class Home extends BaseController
{
    private $db;
    public function __construct()
    {
        helper(['url','form','text']);
        $this->db = \Config\Database::connect();
    }
    public function index(): string
    {
        $title = "Home";
        $data = ['title'=>$title];
        return view('welcome_message',$data);
    }

    public function latestVideos()
    {
        $model = new \App\Models\videoModel();
        $data['page'] = (int) ($this->request->getGet('page') ?? 1);
        $data['perPage'] = 4;

        // Retrieve total count and filtered data
        $data['total'] = $model->where('status', 1)->countAllResults();

        $data['videos'] = $model->where('status', 1)
                            ->orderBy('video_id', 'DESC')
                            ->paginate($data['perPage'], 'default', $data['page']);

        $data['pager'] = $model->pager;
        $data['title']='Videos';
        return view('latest-videos',$data);
    }

    public function watch($id)
    {
        $data['title']='Videos';
        $model = new \App\Models\videoModel();
        $data['video']= $model->where('Token',$id)->first();
        return view('watch',$data);
    }

    public function incrementViews($id)
    {
        if ($this->request->isAJAX()) {
            $ipAddress = $this->request->getIPAddress();
            $viewsModel = new \App\Models\viewsModel();
            $data = ['video_id'=>$id,'total_view'=>1,'date'=>date('Y-m-d'),'ip_address'=>$ipAddress];
            $viewsModel->save($data);

            return $this->response->setJSON(['status' => 'success']);
        }
        return $this->response->setStatusCode(403);
    }

    public function saveWatchTime()
    {
        $data = $this->request->getJSON(true);
        $viewsModel = new \App\Models\viewsModel();
        $ipAddress = $this->request->getIPAddress();
        //get the id
        $views = $viewsModel->WHERE('video_id',$data['video_id'])->WHERE('ip_address',$ipAddress)->first();
        $record = ['watched_seconds'=>$data['watched_seconds']];
        $viewsModel->update($views['view_id'],$record);
        return $this->response->setStatusCode(200);
    }

    public function latestNews()
    {
        $newsModel = new \App\Models\newsModel();
        $data['page'] = (int) ($this->request->getGet('page') ?? 1);
        $data['perPage'] = 4;

        // Retrieve total count and filtered data
        $data['total'] = $newsModel->where('status', 1)->countAllResults();

        $data['news'] = $newsModel->where('status', 1)
                            ->orderBy('news_id', 'DESC')
                            ->paginate($data['perPage'], 'default', $data['page']);

        $data['pager'] = $newsModel->pager;
        //headlines
        $data['headlines'] = $newsModel->WHERE('headline',1)->findAll();
        $data['title'] = "News";
        return view('latest-news',$data);
    }

    public function stories($id)
    {
        $data['title']='News';
        $model = new \App\Models\newsModel();
        $data['story']= $model->where('topic',$id)->first();
        return view('story',$data);
    }

    public function latestEvents()
    {
        $data['title'] = "Events";
        $model = new \App\Models\eventModel();
        $data['page'] = (int) ($this->request->getGet('page') ?? 1);
        $data['perPage'] = 4;

        // Retrieve total count and filtered data
        $data['total'] = $model->where('status', 1)->countAllResults();

        $data['events'] = $model->where('status', 1)
                            ->orderBy('event_id', 'DESC')
                            ->paginate($data['perPage'], 'default', $data['page']);

        $data['pager'] = $model->pager;
        return view('latest-events',$data);
    }

    public function details($id)
    {
        $data['title'] = "Events";
        $model = new \App\Models\eventModel();
        $data['event']= $model->where('event_title',$id)->first();
        return view('details',$data);
    }

    public function shopNearMe()
    {
        $title = "Shop";
        $data = ['title'=>$title];
        return view('shop-near-me',$data);
    }

    public function contactUs()
    {
        $title = "Contact Us";
        $data = ['title'=>$title];
        return view('contact-us',$data);
    }

    //admin
    public function auth()
    {
        return view('auth/login',['validation' => \Config\Services::validation()]);
    }

    public function forgotPassword()
    {
        return view('auth/forgot-password', ['validation' => \Config\Services::validation()]);
    }

    public function dashboard()
    {
        $title = 'Dashboard';
        //total user
        $accountModel = new \App\Models\AccountModel();
        $account = $accountModel->countAllResults();
        //players
        $playerModel = new \App\Models\playerModel();
        $player = $playerModel->countAllResults();
        //team
        $teamModel = new \App\Models\teamModel();
        $team = $teamModel->countAllResults();
        //shops
        $shopModel = new \App\Models\shopModel();
        $shop = $shopModel->countAllResults();
        //events
        $eventModel = new \App\Models\eventModel();
        $event = $eventModel->WHERE('status',1)->ORDERBY('event_id','DESC')->limit(5)->findAll();
        //count all approved events
        $totalEvents = $eventModel->WHERE('status',1)->countAllResults();
        //videos
        $videoModel = new \App\Models\videoModel();
        $video = $videoModel->countAllResults();
        //total views per day
        $builder = $this->db->table('views');
        $builder->select('date,SUM(total_view)total');
        $builder->groupBy('date');
        $views = $builder->get()->getResult();
        //views per video
        $builder = $this->db->table('views a');
        $builder->select(',b.file_name,SUM(a.total_view)total');
        $builder->join('videos b','b.video_id=a.video_id','LEFT');
        $builder->groupBy('a.video_id');
        $video_view = $builder->get()->getResult();
        //video trends
        $builder = $this->db->table('videos a');
        $builder->select('a.file_name,b.total,b.ave_total');
        $builder->join('(select video_id,SUM(total_view)total, AVG(watched_seconds)ave_total from views group by video_id)b','b.video_id=a.video_id','LEFT');
        $builder->groupBy('a.video_id');
        $trends = $builder->get()->getResult();

        $data = ['title'=>$title,'total'=>$account,'player'=>$player,
                'team'=>$team,'shop'=>$shop,'event'=>$event,
                'total_event'=>$totalEvents,'video'=>$video,
                'video_view'=>$video_view,'views'=>$views,'trends'=>$trends];
        return view('main/index',$data);
    }

    //events
    public function events()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['events']==1)
        {
            $title = 'Events';
            $data = [
                'title' => $title
            ];
            return view('main/events/index', $data);
        }
        return redirect()->back();
    }

    public function createEvent()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['events']==1)
        {
            $title = 'New Event';
            $data = [
                'title' => $title
            ];
            return view('main/events/create-event', $data);
        }
        return redirect()->back();
    }

    //matches
    public function matches()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['matches']==1)
        {
            $title = 'Matches';
            $data = [
                'title' => $title
            ];
            return view('main/matches/index', $data);
        }
        return redirect()->back();
    }

    //teams
    public function teams()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['roster']==1)
        {
            $title = 'Teams';
            $data = [
                'title' => $title
            ];
            return view('main/roster/teams/index', $data);
        }
        return redirect()->back();     
    }

    //players
    public function players()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['roster']==1)
        {
            $title = 'Players';
            $data = [
                'title' => $title
            ];
            return view('main/roster/players/index', $data);     
        }
        return redirect()->back();
    }

    //videos
    public function videos()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['videos']==1)
        {
            $title = 'Videos';
            //videos
            $videoModel = new \App\Models\videoModel();
            $video = $videoModel->findAll();
            //sports
            $sportsModel = new \App\Models\sportsModel();
            $sports = $sportsModel->findAll();

            $data = ['title'=>$title,'video'=>$video,'sports'=>$sports];
            return view('main/videos/index', $data);
        }
        return redirect()->back();
    }

    public function uploadVideo()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['videos']==1)
        {
            $title = 'Upload';
            //sports
            $sportsModel = new \App\Models\sportsModel();
            $sports = $sportsModel->findAll();

            $data = ['title'=>$title,'sports'=>$sports];
            return view('main/videos/upload-video', $data);
        }
        return redirect()->back();
    }

    public function editVideo($id)
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['videos']==1)
        {
            $title = 'Edit Video';
            //video
            $videoModel = new \App\Models\videoModel();
            $video = $videoModel->WHERE('Token',$id)->first();
            //sports
            $sportsModel = new \App\Models\sportsModel();
            $sports = $sportsModel->findAll();

            $data = ['title'=>$title,'sports'=>$sports,'video'=>$video];
            return view('main/videos/edit-video', $data);
        }
        return redirect()->back();
    }

    public function liveStream()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['videos']==1)
        {
            $title = "Live Stream";
            $date = date('Y-m-d');
            $time = date('H:i');
            $matchModel = new \App\Models\matchModel();
            $match = $matchModel->WHERE('date',$date)
                                ->WHERE('time >=',$time)
                                ->first();
            //in game 
            $game = $matchModel->WHERE('date',$date)->WHERE('time <=',$time)->WHERE('status',1)->first();
            //code
            $liveCodeModel = new \App\Models\liveCodeModel();
            $code = $liveCodeModel->first();

            $data = ['title'=>$title,'match'=>$match,'game'=>$game,'code'=>$code];
            return view('main/videos/live-stream',$data);
        }
        return redirect()->back();
    }

    public function modifyVideo()
    {
        $videoModel = new \App\Models\videoModel();
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'title'=>'required',
            'category'=>'required',
            'details'=>'required',
            'date'=>'required',
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $id = $this->request->getPost('video_id');
            $file = $this->request->getFile('file');
            $originalName = date('YmdHis').$file->getClientName();
            if(empty($file->getClientName()))
            {
                //save data
                $data = ['file_name'=>$this->request->getPost('title'),
                        'description'=>$this->request->getPost('details'),
                        'sportName'=>$this->request->getPost('category'),
                        'date'=>$this->request->getPost('date'),
                    ];
                $videoModel->update($id,$data);
            }
            else
            {
                $file->move('assets/videos/',$originalName);
                //edit data
                $data = ['file_name'=>$this->request->getPost('title'),
                        'description'=>$this->request->getPost('details'),
                        'file'=>$originalName,
                        'sportName'=>$this->request->getPost('category'),
                        'date'=>$this->request->getPost('date'),
                    ];
                $videoModel->update($id,$data);
            }
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Edit the selected video',
                    'page'=>'Upload'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully uploaded']);
        }
    }

    public function saveVideo()
    {
        $videoModel = new \App\Models\videoModel();
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'title'=>'required',
            'category'=>'required',
            'details'=>'required',
            'date'=>'required',
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            //generate Token
            function generateRandomString($length = 16) {
                // Generate random bytes and convert them to hexadecimal
                $bytes = random_bytes($length);
                return substr(bin2hex($bytes), 0, $length);
            }
            $token_code = generateRandomString(16);
            //save the video
            $file = $this->request->getFile('file');
            $originalName = date('YmdHis').$file->getClientName();
            $file->move('assets/videos/',$originalName);
            //save data
            $data = ['file_name'=>$this->request->getPost('title'),
                    'description'=>$this->request->getPost('details'),
                    'accountID'=>session()->get('loggedUser'),
                    'file'=>$originalName,
                    'sportName'=>$this->request->getPost('category'),
                    'date'=>$this->request->getPost('date'),
                    'status'=>1,
                    'Token'=>$token_code
                ];
            $videoModel->save($data);
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Uploaded new video',
                    'page'=>'Upload'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully uploaded']);
        }
    }

    public function saveCode()
    {
        $liveCodeModel = new \App\Models\liveCodeModel();
        $code = $this->request->getPost('code');
        $data = ['code'=>$code];
        //validate if empty
        $liveCode = $liveCodeModel->first();
        if(empty($liveCode))
        {
            $liveCodeModel->save($data);
        }
        else
        {
            $liveCodeModel->update($liveCode['code_id'],$data);
        }
        return redirect()->back();
    }

    public function filterVideos()
    {
        $category = $this->request->getGet('sport');
        $date = $this->request->getGet('date');
        $text = "%".$this->request->getGet('keyword')."%";
        
        $videoModel = new \App\Models\videoModel();
        if(!empty($category))
        {
            $videos = $videoModel->WHERE('sportName',$category);
        }
        if(!empty($category) && !empty($date))
        {
            $videos = $videoModel->WHERE('sportName',$category)->WHERE('date',$date);
        }
        if(!empty($category) && !empty($date) && empty($text))
        {
            $videos = $videoModel->WHERE('sportName',$category)
                                ->WHERE('date',$date)
                                ->LIKE('file_name',$text);
        }
        if(!empty($category) && empty($text))
        {
            $videos = $videoModel->WHERE('sportName',$category)
                                ->LIKE('file_name',$text);
        }
        if(!empty($date))
        {
            $videos = $videoModel->WHERE('date',$date);
        }

        if(!empty($date)&&!empty($text))
        {
            $videos = $videoModel->WHERE('date',$date)->LIKE('file_name',$text);
        }

        if(!empty($text))
        {
            $videos = $videoModel->LIKE('file_name',$text);
        }
        $result = $videos->findAll();
        foreach($result as $row)
        {
            ?>
<div class="col-sm-6 col-lg-4">
    <div class="card card-sm">
        <a href="<?=site_url('videos/play/')?><?=$row['Token']?>">
            <video src="<?=base_url('admin/videos/')?><?=$row['file']?>" class="card-img-top"></video>
        </a>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <span class="avatar avatar-2 me-3 rounded"
                    style="background-image: url(<?=base_url('assets/images/logo.jpg')?>);"></span>
                <div style="width:100%;">
                    <a href="<?=site_url('videos/play/')?><?=$row['Token']?>">
                        <?=substr($row['file_name'],0,40) ?>...
                    </a><br />
                    <small><?php echo substr($row['description'],0,50) ?>...</small>
                    <div class="text-secondary">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <?=date('M,d Y',strtotime($row['date']))?>
                            </div>
                            <div class="col-lg-6">
                                <a href="<?=site_url('videos/edit/')?><?=$row['Token']?>" style="float:right;">
                                    <i class="ti ti-edit"></i>&nbsp;Edit Video
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
        }

    }

    //news
    public function news()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['news']==1)
        {
            $title = 'News';
            //headlines
            $newsModel  = new \App\Models\newsModel();
            $news = $newsModel->orderBy('news_id','DESC')->limit(9)->findAll();

            $data = ['title'=>$title,'news'=>$news];
            return view('main/news/index', $data);
        }
        return redirect()->back();
    }

    public function createNews()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['news']==1)
        {
            $title = "New Article";
            //sports
            $sportsModel = new \App\Models\sportsModel();
            $sports = $sportsModel->findAll();

            $data = ['title'=>$title,'sports'=>$sports];
            return view('main/news/create', $data);
        }
        return redirect()->back();
    }

    public function editNews($id)
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['news']==1)
        {
            $title = "Edit Article";
            //sports
            $sportsModel = new \App\Models\sportsModel();
            $sports = $sportsModel->findAll();
            //article
            $newsModel = new \App\Models\newsModel();
            $news = $newsModel->WHERE('topic',$id)->first();

            $data = ['title'=>$title,'sports'=>$sports,'news'=>$news];
            return view('main/news/edit', $data);
        }
        return redirect()->back();
    }

    public function savePost()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'article'=>'required|is_unique[news.topic]',
            'author'=>'required',
            'date'=>'required',
            'category'=>'required',
            'details'=>'required',
            'file'=>'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,10240]'
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $newsModel = new \App\Models\newsModel();
            if ($this->request->getPost('agree') !== null)
            {
                $file = $this->request->getFile('file');
                $originalName = date('YmdHis').$file->getClientName();
                //save the logo
                $file->move('assets/images/news/',$originalName);
                $details = str_replace('""','',$this->request->getPost('details'));

                $data = ['date'=>$this->request->getPost('date'),
                        'author'=>$this->request->getPost('author'),
                        'topic'=>$this->request->getPost('article'),
                        'news_type'=>$this->request->getPost('category'),
                        'details'=>$details,
                        'image'=>$originalName,
                        'headline'=>1,
                        'status'=>1,
                        'accountID'=>session()->get('loggedUser')];
                $newsModel->save($data);
            }
            else
            {
                $file = $this->request->getFile('file');
                $originalName = date('YmdHis').$file->getClientName();
                //save the logo
                $file->move('assets/images/news/',$originalName);
                $details = str_replace('""','',$this->request->getPost('details'));

                $data = ['date'=>$this->request->getPost('date'),
                        'author'=>$this->request->getPost('author'),
                        'topic'=>$this->request->getPost('article'),
                        'news_type'=>$this->request->getPost('category'),
                        'details'=>$details,
                        'image'=>$originalName,
                        'headline'=>0,
                        'status'=>1,
                        'accountID'=>session()->get('loggedUser')];
                $newsModel->save($data);
            }
            //logs
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Posted news :'.$this->request->getPost('article'),
                    'page'=>'New Post'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully save and published']);
        }
    }

    public function modifyPost()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'article'=>'required',
            'author'=>'required',
            'date'=>'required',
            'category'=>'required',
            'details'=>'required',
            'status'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $newsModel = new \App\Models\newsModel();
            $news_id = $this->request->getPost('news_id');
            $file = $this->request->getFile('file');
            $originalName = date('YmdHis').$file->getClientName();
            $details = str_replace('""','',$this->request->getPost('details'));
            if ($this->request->getPost('agree') !== null)
            {
                //save the logo
                if(!empty($file->getClientName()))
                {
                    $file->move('assets/images/news/',$originalName);
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'image'=>$originalName,
                                'headline'=>1,
                                'status'=>$this->request->getPost('status'),
                            ];
                    $newsModel->update($news_id,$data);
                }
                else
                {
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'headline'=>1,
                                'status'=>$this->request->getPost('status'),
                            ];
                    $newsModel->update($news_id,$data);
                }
            }
            else
            {
                if(!empty($file->getClientName()))
                {
                    $file->move('assets/images/news/',$originalName);
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'image'=>$originalName,
                                'headline'=>0,
                                'status'=>$this->request->getPost('status'),
                            ];
                    $newsModel->update($news_id,$data);
                }
                else
                {
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'headline'=>0,
                                'status'=>$this->request->getPost('status'),
                            ];
                    $newsModel->update($news_id,$data);
                }
            }
            return $this->response->SetJSON(['success' => 'Successfully applied changes']);
        }
    }

    public function saveDraft()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'article'=>'required',
            'author'=>'required',
            'date'=>'required',
            'category'=>'required',
            'details'=>'required',
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $newsModel = new \App\Models\newsModel();
            $file = $this->request->getFile('file');
            $originalName = date('YmdHis').$file->getClientName();
            $details = str_replace('""','',$this->request->getPost('details'));
            if ($this->request->getPost('agree') !== null)
            {
                //save the logo
                if(!empty($file->getClientName()))
                {
                    $file->move('assets/images/news/',$originalName);
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'image'=>$originalName,
                                'headline'=>1,
                                'status'=>3,
                                'accountID'=>session()->get('loggedUser')
                            ];
                    $newsModel->save($data);
                }
                else
                {
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'headline'=>1,
                                'status'=>3,
                                'accountID'=>session()->get('loggedUser')
                            ];
                    $newsModel->save($data);
                }
            }
            else
            {
                if(!empty($file->getClientName()))
                {
                    $file->move('assets/images/news/',$originalName);
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'image'=>$originalName,
                                'headline'=>0,
                                'status'=>3,
                                'accountID'=>session()->get('loggedUser')
                            ];
                    $newsModel->save($data);
                }
                else
                {
                    $data = [
                                'date'=>$this->request->getPost('date'),
                                'author'=>$this->request->getPost('author'),
                                'topic'=>$this->request->getPost('article'),
                                'news_type'=>$this->request->getPost('category'),
                                'details'=>$details,
                                'headline'=>0,
                                'status'=>3,
                                'accountID'=>session()->get('loggedUser')
                            ];
                    $newsModel->save($data);
                }
            }
            return $this->response->SetJSON(['success' => 'Successfully applied changes']);
        }
    }

    public function filterNews()
    {
        $newsModel = new \App\Models\newsModel();
        $date = $this->request->getGet('date');
        $type = $this->request->getGet('type');
        if(!empty($date)&& empty($type))
        {
            $news = $newsModel->WHERE('date',$date)->findAll();
            foreach($news as $row)
            {
                ?>
<div class="col-sm-6 col-lg-3">
    <div class="card card-sm">
        <a href="<?=site_url('news/topic/')?><?=$row['topic'] ?>">
            <img src="<?=base_url('assets/images/news/')?><?=$row['image']?>" class="card-img-top"
                style="width: 100%; height: 200px;" />
        </a>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <span class="avatar avatar-2 me-3 rounded"
                    style="background-image: url(<?=base_url('assets/images/avatar.jpg')?>);"></span>
                <div style="width:100%;">
                    <a href="<?=site_url('news/topic/')?><?=$row['topic'] ?>"><?=$row['topic'] ?></a>
                    <div class="text-secondary">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <?=date('M,d Y',strtotime($row['date']))?>
                            </div>
                            <div class="col-lg-6">
                                <?php if($row['status']==1): ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-primary text-white" style="float:right;">Published</span>
                                <?php elseif($row['status']==3): ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-secondary text-white" style="float:right;">Draft</span>
                                <?php else : ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-danger text-white" style="float:right;">Archive</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
            }
        }
        else if(!empty($date)&& !empty($type))
        {
            $news = $newsModel->WHERE('date',$date)->WHERE('status',$type)->findAll();
            foreach($news as $row)
            {
                ?>
<div class="col-sm-6 col-lg-3">
    <div class="card card-sm">
        <a href="<?=site_url('news/topic/')?><?=$row['topic'] ?>">
            <img src="<?=base_url('assets/images/news/')?><?=$row['image']?>" class="card-img-top"
                style="width: 100%; height: 200px;" />
        </a>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <span class="avatar avatar-2 me-3 rounded"
                    style="background-image: url(<?=base_url('assets/images/avatar.jpg')?>);"></span>
                <div style="width:100%;">
                    <a href="<?=site_url('news/topic/')?><?=$row['topic'] ?>"><?=$row['topic'] ?></a>
                    <div class="text-secondary">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <?=date('M,d Y',strtotime($row['date']))?>
                            </div>
                            <div class="col-lg-6">
                                <?php if($row['status']==1): ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-primary text-white" style="float:right;">Published</span>
                                <?php elseif($row['status']==3): ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-secondary text-white" style="float:right;">Draft</span>
                                <?php else : ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-danger text-white" style="float:right;">Archive</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
            }
        }
        else if(empty($date)&& !empty($type))
        {
            $news = $newsModel->WHERE('status',$type)->findAll();
            foreach($news as $row)
            {
                ?>
<div class="col-sm-6 col-lg-3">
    <div class="card card-sm">
        <a href="<?=site_url('news/topic/')?><?=$row['topic'] ?>">
            <img src="<?=base_url('assets/images/news/')?><?=$row['image']?>" class="card-img-top"
                style="width: 100%; height: 200px;" />
        </a>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <span class="avatar avatar-2 me-3 rounded"
                    style="background-image: url(<?=base_url('assets/images/avatar.jpg')?>);"></span>
                <div style="width:100%;">
                    <a href="<?=site_url('news/topic/')?><?=$row['topic'] ?>"><?=$row['topic'] ?></a>
                    <div class="text-secondary">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <?=date('M,d Y',strtotime($row['date']))?>
                            </div>
                            <div class="col-lg-6">
                                <?php if($row['status']==1): ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-primary text-white" style="float:right;">Published</span>
                                <?php elseif($row['status']==3): ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-secondary text-white" style="float:right;">Draft</span>
                                <?php else : ?>
                                <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                    style="float:right;margin-left:10px;"><i class="ti ti-edit"></i>&nbsp;Edit</a>
                                <span class="badge bg-danger text-white" style="float:right;">Archive</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
            }
        }
    }

    //shops
    public function shops()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['shops']==1)
        {
            $title = 'Shops';
            $shopModel = new \App\Models\shopModel();
            $shop = $shopModel->orderBy('shop_id','DESC')->limit(5)->findAll();

            $data = ['title'=>$title,'shop'=>$shop];
            return view('main/shop/index', $data); 
        }
        return redirect()->back();
    }

    public function fetchShop()
    {
        $id = $this->request->getGet('value');
        $shopModel = new \App\Models\shopModel();
        $shop = $shopModel->WHERE('shop_id',$id)->first();
        if($shop)
        {
            ?>
<form method="POST" class="row g-3" id="frmEditShop">
    <?=csrf_field()?>
    <input type="hidden" id="shop_id" name="shop_id" value="<?=$shop['shop_id']?>" />
    <input type="hidden" id="longitude" name="longitude" value="<?=$shop['longitude']?>" />
    <input type="hidden" id="latitude" name="latitude" value="<?=$shop['latitude']?>" />
    <div class="col-lg-12">
        <label class="form-label">Name of the Shop</label>
        <input type="text" class="form-control" name="name_shop" value="<?=$shop['shop_name']?>" required />
        <div id="name_shop-error" class="error-message text-danger text-sm"></div>
    </div>
    <div class="col-lg-12">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" required><?=$shop['address']?></textarea>
        <div id="address-error" class="error-message text-danger text-sm"></div>
    </div>
    <div class="col-lg-12">
        <label class="form-label">Website</label>
        <input type="text" class="form-control" name="website" value="<?=$shop['website']?>" required />
        <div id="website-error" class="error-message text-danger text-sm"></div>
    </div>
    <div class="col-lg-12">
        <button type="submit" class="btn btn-primary save">
            <i class="ti ti-device-floppy"></i>&nbsp;Save Changes
        </button>
    </div>
</form>
<?php
        }
    }

    public function editShop()
    {
        $shopModel = new \App\Models\shopModel();
        $validation = $this->validate([
            'csrf_test_name'=>'required',
            'name_shop'=>'required',
            'address'=>'required',
            'website'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $data = ['longitude'=>$this->request->getPost('longitude'),
                    'latitude'=>$this->request->getPost('latitude'),
                    'shop_name'=>$this->request->getPost('name_shop'),
                    'address'=>$this->request->getPost('address'),
                    'website'=>$this->request->getPost('website'),
                    'date'=>date('Y-m-d')];
            $shopModel->update($this->request->getPost('shop_id'),$data);
            //logs
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Edit shop : '.$this->request->getPost('name_shop'),
                    'page'=>'Shops'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully applied changes']);
        }
    }

    public function shopLocation()
    {
        $shopModel = new \App\Models\shopModel();
        $shops = $shopModel->findAll();
        $locations = [];
        foreach($shops as $row)
        {
            $locations[] = ['latitude'=>$row['latitude'],
                            'longitude'=>$row['longitude'],
                            'shop_name' => $row['shop_name'],
                            'address' => $row['address'],
                            'website'=>$row['website']];
        }
        echo json_encode($locations);
    }

    public function saveShop()
    {
        $shopModel = new \App\Models\shopModel();
        $validation = $this->validate([
            'csrf_test_name'=>'required',
            'name_shop'=>'required|is_unique[shops.shop_name]',
            'address'=>'required',
            'website'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $data = ['longitude'=>$this->request->getPost('longitude'),
                    'latitude'=>$this->request->getPost('latitude'),
                    'shop_name'=>$this->request->getPost('name_shop'),
                    'address'=>$this->request->getPost('address'),
                    'website'=>$this->request->getPost('website'),
                    'date'=>date('Y-m-d')];
            $shopModel->save($data);
            //logs
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Added new shop : '.$this->request->getPost('name_shop'),
                    'page'=>'Shops'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully added']);
        }
    }

    //maintenance
    public function recovery()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['maintenance']==1)
        {
            $title = 'Recovery';
            $data = [
                'title' => $title
            ];
            return view('main/maintenance/recovery', $data);
        }
        return redirect()->back();
    }

    public function settings()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['maintenance']==1)
        {
            $title = 'Settings';
            //sports
            $sportsModel = new \App\Models\sportsModel();
            $sports = $sportsModel->findAll();
            //logs
            $builder = $this->db->table('logs a');
            $builder->select('a.*,b.Fullname');
            $builder->join('accounts b','b.accountID=a.accountID','LEFT');
            $logs = $builder->get()->getResult();

            $data = ['title'=>$title,'sports'=>$sports,'logs'=>$logs];
            return view('main/maintenance/settings', $data);
        }
        return redirect()->back();
    }

    public function savePermission()
    {
        $permissionModel = new \App\Models\user_permission();
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'role'=>'required|is_unique[user_permissions.role]',
            'roster'=>'required|numeric',
            'events'=>'required|numeric',
            'matches'=>'required|numeric',
            'videos'=>'required|numeric',
            'news'=>'required|numeric',
            'shops'=>'required|numeric',
            'maintenance'=>'required|numeric'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                    'role'=>$this->request->getPost('role'),
                    'roster'=>$this->request->getPost('roster'),
                    'events'=>$this->request->getPost('events'),
                    'matches'=>$this->request->getPost('matches'),
                    'videos'=>$this->request->getPost('videos'),
                    'news'=>$this->request->getPost('news'),
                    'shops'=>$this->request->getPost('shops'),
                    'maintenance'=>$this->request->getPost('maintenance')
                    ];
            $permissionModel->save($data);
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Added new user permission',
                    'page'=>'Settings'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully added']);
        }
    }

    public function fetchSpecificPermission()
    {
        $val = $this->request->getGet('value');
        $permissionModel = new \App\Models\user_permission();
        $permission = $permissionModel->where('up_id',$val)->first();
        echo $permission['role'];
    }

    public function editPermission()
    {
        $permissionModel = new \App\Models\user_permission();
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'edit-role'=>'required',
            'edit-roster'=>'required|numeric',
            'edit-events'=>'required|numeric',
            'edit-matches'=>'required|numeric',
            'edit-videos'=>'required|numeric',
            'edit-news'=>'required|numeric',
            'edit-shops'=>'required|numeric',
            'edit-maintenance'=>'required|numeric'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $id = $this->request->getPost('role_id');
            $data = [
                    'role'=>$this->request->getPost('edit-role'),
                    'roster'=>$this->request->getPost('edit-roster'),
                    'events'=>$this->request->getPost('edit-events'),
                    'matches'=>$this->request->getPost('edit-matches'),
                    'videos'=>$this->request->getPost('edit-videos'),
                    'news'=>$this->request->getPost('edit-news'),
                    'shops'=>$this->request->getPost('edit-shops'),
                    'maintenance'=>$this->request->getPost('edit-maintenance')
                    ];
            $permissionModel->update($id,$data);
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Modify user permission',
                    'page'=>'Settings'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully applied changes']);
        }
    }

    public function fetchPermission()
    {
        $searchTerm = $_GET['search']['value'] ?? '';
        $permissionModel = new \App\Models\user_permission();
        // Apply the search filter for the main query
        if ($searchTerm) {
            $permissionModel->like('role', $searchTerm);   
        }
        // Pagination: Get the 'start' and 'length' from the request (these are sent by DataTables)
        $limit = $_GET['length'] ?? 10;  // Number of records per page, default is 10
        $offset = $_GET['start'] ?? 0;   // Starting record for pagination, default is 0
        // Clone the model for counting filtered records, while keeping the original for data fetching
        $filteredPermissionModel = clone $permissionModel;
        if ($searchTerm) {
            $filteredPermissionModel->like('role', $searchTerm);
        }
        // Fetch filtered records based on limit and offset
        $permissions = $permissionModel->findAll($limit, $offset);  
        // Count total records (without filter)
        $totalRecords = $permissionModel->countAllResults();
        // Count filtered records (with filter)
        $filteredRecords = $filteredPermissionModel->countAllResults();
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($permissions as $row) {
            $response['data'][] = [
                'roleName' => htmlspecialchars($row['role'], ENT_QUOTES),
                'roster' => ($row['roster']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'events' => ($row['events']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'matches' => ($row['matches']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'videos' => ($row['videos']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',       
                'news' => ($row['news']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'shops' => ($row['shops']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'maintenance' => ($row['maintenance']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'action' => '<button type="button" class="btn btn-primary edit_permission" value="' . $row['up_id'] . '"><i class="ti ti-edit"></i> Edit </button>'
            ];
        }
        return $this->response->setJSON($response);
    }       

    public function saveSports()
    {
        $sportsModel = new \App\Models\sportsModel();
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'sports'=>'required|is_unique[sports.Name]'
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $data = ['Name'=>$this->request->getPost('sports'),'DateCreated'=>date('Y-m-d')];
            $sportsModel->save($data);
            //logs
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Added new sports',
                    'page'=>'Settings'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully saved']);
        }
    }

    public function fetchSports()
    {
        $sportsModel = new \App\Models\sportsModel();
        $searchTerm = $_GET['search']['value'] ?? '';

        // Apply the search filter for the main query
        if ($searchTerm) {
            $sportsModel->like('sportsID', $searchTerm)
                            ->orLike('Name', $searchTerm)
                            ->orLike('DateCreated', $searchTerm);
        }

        // Pagination: Get the 'start' and 'length' from the request (these are sent by DataTables)
        $limit = $_GET['length'] ?? 10;  // Number of records per page, default is 10
        $offset = $_GET['start'] ?? 0;   // Starting record for pagination, default is 0

        // Clone the model for counting filtered records, while keeping the original for data fetching
        $filteredsportsModel = clone $sportsModel;
        if ($searchTerm) {
            $filteredsportsModel->like('sportsID', $searchTerm)
                            ->orLike('Name', $searchTerm)
                            ->orLike('DateCreated', $searchTerm);
        }

        // Fetch filtered records based on limit and offset
        $account = $sportsModel->findAll($limit, $offset);

        // Count total records (without filter)
        $totalRecords = $sportsModel->countAllResults();

        // Count filtered records (with filter)
        $filteredRecords = $filteredsportsModel->countAllResults();

        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($account as $row) {
            $response['data'][] = [
                'id' => $row['sportsID'],
                'name' => htmlspecialchars($row['Name'], ENT_QUOTES),
                'date' => htmlspecialchars(date('Y-M-d',strtotime($row['DateCreated'])), ENT_QUOTES),
                'action' =>'<button type="button" class="btn btn-sm btn-danger remove" value="' . $row['sportsID'] . '"><i class="ti ti-copy-x"></i> Remove </button>' 
            ];
        }
        // Return the response as JSON
        return $this->response->setJSON($response);
    }

    public function saveRole()
    {
        $roleModel = new \App\Models\roleModel();
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'sports_name'=>'required',
            'role'=>'required|is_unique[player_role.roleName]'
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $data = ['roleName'=>$this->request->getPost('role'),
                    'sportsName'=>$this->request->getPost('sports_name'),
                    'DateCreated'=>date('Y-m-d')];
            $roleModel->save($data);
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Added new player role',
                    'page'=>'Settings'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully saved']);
        }
    }

    public function fetchRole()
    {
        $roleModel = new \App\Models\roleModel();
        $searchTerm = $_GET['search']['value'] ?? '';

        // Apply the search filter for the main query
        if ($searchTerm) {
            $roleModel->like('roleID', $searchTerm)
                            ->orLike('roleName', $searchTerm)
                            ->orLike('sportsName', $searchTerm)
                            ->orLike('DateCreated', $searchTerm);
        }

        // Pagination: Get the 'start' and 'length' from the request (these are sent by DataTables)
        $limit = $_GET['length'] ?? 10;  // Number of records per page, default is 10
        $offset = $_GET['start'] ?? 0;   // Starting record for pagination, default is 0

        // Clone the model for counting filtered records, while keeping the original for data fetching
        $filteredroleModel = clone $roleModel;
        if ($searchTerm) {
            $filteredroleModel->like('roleID', $searchTerm)
                            ->orLike('roleName', $searchTerm)
                            ->orLike('sportsName', $searchTerm)
                            ->orLike('DateCreated', $searchTerm);
        }

        // Fetch filtered records based on limit and offset
        $account = $roleModel->findAll($limit, $offset);

        // Count total records (without filter)
        $totalRecords = $roleModel->countAllResults();

        // Count filtered records (with filter)
        $filteredRecords = $filteredroleModel->countAllResults();

        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($account as $row) {
            $response['data'][] = [
                'id' => $row['roleID'],
                'role' => htmlspecialchars($row['roleName'], ENT_QUOTES),
                'sports' => htmlspecialchars($row['sportsName'], ENT_QUOTES),
                'date' => htmlspecialchars(date('Y-M-d',strtotime($row['DateCreated'])), ENT_QUOTES),
                'action' =>'<button type="button" class="btn btn-sm btn-danger remove" value="' . $row['roleID'] . '"><i class="ti ti-copy-x"></i> Remove </button>' 
            ];
        }
        // Return the response as JSON
        return $this->response->setJSON($response);
    }

    public function fetchAchievement()
    {
        $achievementModel = new \App\Models\achievementModel();
        $searchTerm = $_GET['search']['value'] ?? '';

        // Apply the search filter for the main query
        if ($searchTerm) {
            $achievementModel->like('title', $searchTerm)
                            ->orLike('type', $searchTerm)
                            ->orLike('description', $searchTerm)
                            ->orLike('criteria', $searchTerm);
        }

        // Pagination: Get the 'start' and 'length' from the request (these are sent by DataTables)
        $limit = $_GET['length'] ?? 10;  // Number of records per page, default is 10
        $offset = $_GET['start'] ?? 0;   // Starting record for pagination, default is 0

        // Clone the model for counting filtered records, while keeping the original for data fetching
        $filteredachievementModel = clone $achievementModel;
        if ($searchTerm) {
            $filteredachievementModel->like('title', $searchTerm)
                            ->orLike('type', $searchTerm)
                            ->orLike('description', $searchTerm)
                            ->orLike('criteria', $searchTerm);
        }

        // Fetch filtered records based on limit and offset
        $account = $achievementModel->findAll($limit, $offset);

        // Count total records (without filter)
        $totalRecords = $achievementModel->countAllResults();

        // Count filtered records (with filter)
        $filteredRecords = $filteredachievementModel->countAllResults();

        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($account as $row) {
            $response['data'][] = [
                'title' => $row['name'],
                'type' => htmlspecialchars($row['type'], ENT_QUOTES),
                'description' => htmlspecialchars($row['description'], ENT_QUOTES),
                'criteria' => $row['criteria'],
                'action' =>'<button type="button" class="btn btn-sm btn-danger remove" value="' . $row['achievement_id'] . '"><i class="ti ti-copy-x"></i> Remove </button>' 
            ];
        }
        // Return the response as JSON
        return $this->response->setJSON($response);
    }

    public function saveAchievement()
    {
        $achievementModel = new \App\Models\achievementModel();
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'title'=>'required|is_unique[achievements.name]',
            'type'=>'required',
            'description'=>'required',
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $data = ['name'=>$this->request->getPost('title'),
                    'description'=>$this->request->getPost('description'),
                    'type'=>$this->request->getPost('type'),
                    'criteria'=>$this->request->getPost('criteria'),
                    'date_created'=>date('Y-m-d')];
            $achievementModel->save($data);
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Added new achievement',
                    'page'=>'Settings'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully added']);
        }
    }
    
    //accounts
    public function accounts()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['maintenance']==1)
        {
            $title = 'Accounts';
            $data = [
                'title' => $title
            ];
            return view('main/maintenance/accounts/index', $data);
        }
        return redirect()->back();
    }   

    public function createAccount()
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['maintenance']==1)
        {
            $title = 'Create Account';
            //user permission
            $permissionModel = new \App\Models\user_permission();
            $permission = $permissionModel->findAll();
            //get the top 5 recently added
            $accountModel = new \App\Models\AccountModel();
            $account = $accountModel->orderBy('accountID', 'DESC')->limit(5)->findAll();
            $data = [
                'title' => $title,
                'account' => $account,
                'permission'=>$permission
            ];
            return view('main/maintenance/accounts/create-account', $data);
        }
        return redirect()->back();
    }
    public function editAccount($id)
    {
        $permissionModel = new \App\Models\user_permission();
        $role = $permissionModel->where('role',session()->get('role'))->first();
        if($role['maintenance']==1)
        {
            $title = 'Edit Account';
            //user permission
            $permissionModel = new \App\Models\user_permission();
            $permission = $permissionModel->findAll();
            //info
            $accountModel = new \App\Models\AccountModel();
            $account = $accountModel->WHERE('Token',$id)->first();
            $data = [
                'title' => $title,
                'id' => $id,
                'account' => $account,
                'permission'=>$permission
            ];
            return view('main/maintenance/accounts/edit-account', $data);
        }
        return redirect()->back();
    }

    public function saveAccount()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'fullname'=>'required',
            'email'=>'required|valid_email|is_unique[accounts.Email]',
            'role'=>'required',
            'status'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            function generateRandomString($length = 64) {
                // Generate random bytes and convert them to hexadecimal
                $bytes = random_bytes($length);
                return substr(bin2hex($bytes), 0, $length);
            }
            $token_code = generateRandomString(64);
            $accountModel = new \App\Models\AccountModel();
            $data = ['Email'=>$this->request->getPost('email'),
                    'Password'=>Hash::make('Abc12345?'),
                    'Fullname'=>$this->request->getPost('fullname'),
                    'Role'=>$this->request->getPost('role'),
                    'Status'=>$this->request->getPost('status'),
                    'Token'=>$token_code,
                    'DateCreated'=>date('Y-m-d')];
            $accountModel->save($data);
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Register new user',
                    'page'=>'New Account'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully submitted']);
        }
    }

    public function updateAccount()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'fullname'=>'required',
            'email'=>'required|valid_email',
            'role'=>'required',
            'status'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $accountModel = new \App\Models\AccountModel();
            $data = ['Email'=>$this->request->getPost('email'),
                    'Fullname'=>$this->request->getPost('fullname'),
                    'Role'=>$this->request->getPost('role'),
                    'Status'=>$this->request->getPost('status')];
            $accountModel->update($this->request->getPost('accountID'),$data);
            //logs
            $logModel = new \App\Models\logModel();
            $data = [
                    'date'=>date('Y-m-d H:i:s a'),
                    'accountID'=>session()->get('loggedUser'),
                    'activities'=>'Update account for '.$this->request->getPost('fullname'),
                    'page'=>'Edit Account'
                    ];        
            $logModel->save($data);
            return $this->response->SetJSON(['success' => 'Successfully applied changes']);
        }
    }

    public function resetAccount()
    {
        $val = $this->request->getPost('value');
        $accountModel = new \App\Models\AccountModel();
        $data = ['Password'=>Hash::make('Abc12345?')];
        $accountModel->update($val,$data);
        //logs
        $logModel = new \App\Models\logModel();
        $data = [
                'date'=>date('Y-m-d H:i:s a'),
                'accountID'=>session()->get('loggedUser'),
                'activities'=>'Reset password',
                'page'=>'Accounts'
                ];        
        $logModel->save($data);
        return $this->response->SetJSON(['success' => 'Successfully reset the account']);
    }

    public function fetchAccounts()
    {
        $accountModel = new \App\Models\AccountModel();
        $searchTerm = $_GET['search']['value'] ?? '';

        // Apply the search filter for the main query
        if ($searchTerm) {
            $accountModel->like('accountID', $searchTerm)
                            ->orLike('Email', $searchTerm)
                            ->orLike('Fullname', $searchTerm)
                            ->orLike('Role', $searchTerm);
        }

        // Pagination: Get the 'start' and 'length' from the request (these are sent by DataTables)
        $limit = $_GET['length'] ?? 10;  // Number of records per page, default is 10
        $offset = $_GET['start'] ?? 0;   // Starting record for pagination, default is 0

        // Clone the model for counting filtered records, while keeping the original for data fetching
        $filteredaccountModel = clone $accountModel;
        if ($searchTerm) {
            $filteredaccountModel->like('accountID', $searchTerm)
                            ->orLike('Email', $searchTerm)
                            ->orLike('Fullname', $searchTerm)
                            ->orLike('Role', $searchTerm);
        }

        // Fetch filtered records based on limit and offset
        $account = $accountModel->findAll($limit, $offset);

        // Count total records (without filter)
        $totalRecords = $accountModel->countAllResults();

        // Count filtered records (with filter)
        $filteredRecords = $filteredaccountModel->countAllResults();

        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($account as $row) {
            $response['data'][] = [
                'id' => $row['accountID'],
                'email' => htmlspecialchars($row['Email'], ENT_QUOTES),
                'fullname' => htmlspecialchars($row['Fullname'], ENT_QUOTES),
                'role' => htmlspecialchars($row['Role'], ENT_QUOTES),
                'status' => ($row['Status'] == 0) ? '<span class="badge bg-danger text-white">Inactive</span>' : 
                '<span class="badge bg-success text-white">Active</span>',
                'action' => ($row['Status'] == 1) 
                    ? '<a href="' . site_url("accounts/edit") . '/' . $row['Token'] . '" class="btn btn-primary"><i class="ti ti-edit"></i> Edit </a>&nbsp;<button type="button" class="btn btn-secondary reset" value="' . $row['accountID'] . '"><i class="ti ti-refresh"></i> Reset </button>' 
                    : '<a href="' . site_url("accounts/edit") . '/' . $row['Token'] . '" class="btn btn-primary"><i class="ti ti-edit"></i> Edit </a>'
            ];
        }
        // Return the response as JSON
        return $this->response->setJSON($response);
    }

    public function myAccount()
    {
        $title = 'My Account';
        $accountModel = new \App\Models\AccountModel();
        $user = session()->get('loggedUser');
        $account = $accountModel->WHERE('accountID',$user)->first();
        $data = [
            'title' => $title,
            'account'=>$account
        ];
        return view('main/my-account', $data);
    }

    public function changePassword()
    {
        $accountModel = new \App\Models\AccountModel();
        $user = session()->get('loggedUser');
        $validation = $this->validate([
            'current_password'=>'required|min_length[8]|max_length[12]|regex_match[/[A-Z]/]|regex_match[/[a-z]/]|regex_match[/[0-9]/]',
            'new_password'=>'required|min_length[8]|max_length[12]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).+$/]',
            'confirm_password'=>'required|matches[new_password]',
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $oldpassword = $this->request->getPost('current_password');
            $newpassword = $this->request->getPost('new_password');

            $account = $accountModel->WHERE('accountID',$user)->first();
            $checkPassword = Hash::check($oldpassword,$account['Password']);
            if(!$checkPassword||empty($checkPassword))
            {
                $error = ['current_password'=>'Password mismatched. Please try again'];
                return $this->response->SetJSON(['error' => $error]);
            }
            else
            {
                if(($oldpassword==$newpassword))
                {
                    $error = ['new_password'=>'The new password cannot be the same as the current password.'];
                    return $this->response->SetJSON(['error' => $error]);
                }
                else
                {
                    $HashPassword = Hash::make($newpassword);
                    $data = ['Password'=>$HashPassword];
                    $accountModel->update($user,$data);
                    return $this->response->setJSON(['success' => 'Successfully submitted']);
                }
            }
        }
    }

}