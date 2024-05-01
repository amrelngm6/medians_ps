<?php
namespace Medians\Languages\Application;

use Shared\dbaser\CustomController;

use Medians\Languages\Infrastructure\TranslationRepository;
use Medians\Languages\Infrastructure\LanguageRepository;

class TranslationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $languageRepo;

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new TranslationRepository();
		
		$this->languageRepo = new LanguageRepository();

	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            // [ 'value'=> "translation_id", 'text'=> "#",'sortable'=> true],
            [ 'value'=> "code", 'text'=> translate('Code'), 'sortable'=> true ],
            [ 'value'=> "language.name", 'text'=> translate('language'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('Edit') ],
            [ 'value'=> "delete", 'text'=> translate('delete') ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

	}

	

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index( ) 
	{
		

		$a = json_decode('{
			"direction" : "rtl",
      "sitename":"Medians Trips",
      "Profile":"الصفحة الشخصية",
      "help":"المساعدة",
      "error":"خطأ",
      "first_name":"الإسم الأول",
      "last_name":"الإسم الاخير",
      "your_active_trip":"رحلتك الحالية",
      "continue_trip":"إستكمال الرحلة",
      "start_trip":"بدء الرحلة",
      "start_morning_trip":"بدء الرحلة الصباحية",
      "start_afternoon_trip":"بدء الرحلة المسائية",
      "morning":"صباحا",
      "afternoon":"مساءا",
      "welcome":"مرحبا بك",
      "send_message":"إرسال رسالة",
      "have_a_problem":"هل لديك مشكلة ؟",
      "follow_your_upcoming_trips_from_this_list":"يمكنك متابعة رحلاتك القادمة و الحالية من هنا",
      "trips_history":"سجل الرحلات السابقة",
      "your_route":"خط السير الخاص بك",
      "current_trip":"الرحلة الحالية",
      "route":"خط السير",
      "send_message_if_you_need_any_help":"يمكنك إرسال رسالة الى الدعم الفني للمساعدة",
      "trip":"رحلة",
      "email":"البريد الإلكتروني",
      "view_trip":"عرض الرحلة",
      "view_more":"عرض المزيد",
      "end_trip":"إنهاء الرحلة",
      "we_can_help":"يمكننا المساعدة",
      "pickup_done": "تم الإنهاء",
      "Delivered": "تم التوصيل",
      "welcome_back": "أهلا بعودتك",
      "password": "كلمة المرور",
      "sign_in": "تسجيل الدخول",
      "create_new_account": "إنشاء حساب جديد",
      "route_pickup_locations": "نقاط توقف خط السير",
      "pickup_locations": "أماكن التوقف",
      "call": "إتصال",
      "close": "إغلاق",
      "show_map": "عرض علي الخريطة",
      "get_in_contact": "تواصل بشكل مباشر",
      "search_by_name": "البحث عن طريق الإسم أو العنوان",
      "login_intro_message" : "تابع عملك بكل أمان. \nيرجي تسجيل الدخول إلي حسابك.",
      "signup_intro_message" : "إبدأ عملك فورا. \nيمكنك إنشاء حسابك.",
      "distance_to_pickup_location": "المسافة بينك وبين نفطة التوقف ",

      "list_of_route_pickup_locations":"عرض سجل جميع الرحلات السابقة",
      "view_all_trips_history":"عرض سجل جميع الرحلات السابقة",
      "send_your_message_below":"إذا كان لديك أي مشكلة أو بحاجة الى المساعدة, \n أرسل رسالتك هنا",
      "subject": "الموضوع", 
      "send_now": "إرسل الان", 
      "message": "الرسالة",
      "your_message_here": "إكتب رسالتك هنا ...",
      "your_message": "رسالتك",
      "allow_recieve_notifications": "السماح بإستلام التنبيهات",
      "notifications": "التنبيهات",
      "language": "اللغة",
      "languages": "اللغات",
      "help_page": "صفحة المساعدة",
      "select_your_language": "إختر لغتك المفضلة",
      "trip_sueccessfully_ended": "تم إنهاء الرحلة بنجاح",
      "trip_duration": "مدة الرحلة",
      "trip_number": "رقم الرحلة",
      "trip_status": "حالة الرحلة",
      "completed": "إنتهت", 
      "pickups": "نقاط التوقف",
      "license_number": "رقم الرخصة",
      "contact_number": "رقم التواصل",
      "you_have_no_route_yet": "ليس لديك أى خطوط سير مرتبطة بحسابك",
      "no_data_here": "لا يوجد بيانات",
      "going": "ذهاب",
      "back": "عودة",
      "no_pickup_locations_at_this_trip": "لا يوجد نقاط توقف في هذه الرحلة",
      "no_pickup_locations_at_this_route": "لا يوجد نقاط توقف في خط السير",
      "no_pickup_locations_here": "لا يوجد نقاط توقف هنا",
      "your_help_messages": "رسائل المساعدة التي ارسلتها",
      "ticket_number": "رقم المتابعة",
      "department": "القسم",
      "status": "الحالة",
      "priority": "الأولوية",
      "time": "الوقت",
      "support_comments": "تعليقات الدعم الفني",
      "comment": "التعليق",
      "view_ticket" : "عرض الرسالة",
      "notifications_list" : "قائمة التنبيهات",
      "list_of_your_notifications" : "قائمة لأحدث التنبيهات و الإشعارات الخاصة بك",
      "your_old_sent_messages_list" : "الرسائل المرسلة",
      "click_here_to_view_your_previous_sent_messages" : "قائمة بالرسائل التي تم إرسالها من قبل",
      "new" : "جديدة",
      "all" : "الجميع",
      "logout" : "تسجيل الخروج",
      "closed" : "مغلقة",
      "app_preferences" : "إعدادات التطبيق",
      "get_permission" : "عرض الصلاحيات",
      "get_permissions" : "عرض الصلاحيات",
      "dark_mode" : "النظام الليلي",
      "show_template_in_darkmode" : "عرض التصميم بألوان داكنة",
      "next" : "التالي",
      "set_your_custom_configuration" : "قم بضبط إعداداتك الخاصة",
      "start_now" : "إبدأ الان",
      "start_with_your_account" : "إبدأ الان بحسابك الشخصي",
      "some_permissions_are_required_to_use_the_app" : "بعض الصلاحيات مطلوبة لإستخدام التطبيق",
      "create_your_account" : "انشيْ حسابك الان",
      "forgot_password": "نسيت كلمة المرور ؟",
      "confirm" : "تأكيد",
      "view" : "عرض",
      "updated" : "تم التحديث",
      "updated_successfully" : "تم التحديث بنجاح",
      "available_routes" : "خطوط السير المتاحة",
      "list_of_your_added_children" : "قائمة بالأطفال الذين تم إضافتهم",
      "view_details" : "عرض التفاصيل",
      "add_student" : "إضافة طالب",
      "add_new_student_now" : "إضافة طالب جديد الان",
      "start_now_with_filling_new_student_information" : "إبدأ الان باضافة بيانات الطالب وسيتم المراجعة والرد عليك بأقرب وقت",
      "student_info_updated" : "سيتم مراجعة البيانات و سيتم التواصل معك في أقرب وقت",
      "forgot_password_message" : "سيتم إرسال رقم التأكيد علي البريد الإلكتروني",
      "scheduled" : "تم الحجز",
      "trips" : "الرحلات",
      "working_days" : "أيام الدراسة",
      "week_days_that_you_need_to_pickup" : "أيام الأسبوع التي يتم الالتقاء فيها",
      "vacations" : "الأجازات",
      "vacations_days_subtitle" : "أيام الأجازات او الغياب",
      "pickup_and_destinations" : "أماكن اللقاء و التوصيل",
      "locations" : "المواقع",
      "save" : "حفظ",
      "go_home" : "الذهاب للرئيسية",
      "approved" : "تم التأكيد",
      "pending" : "قيد الانتظار",
      "change_password" : "تغيير كلمة المرور",
      "current_password" : "كلمة المرور الحالية",
      "new_password" : "كلمة المرور الجديدة",
      "confirm_password" : "تأكيد كلمة المرور",
      "change_password_message" : "يمكنك تغيير كلمة المرور من هنا, ويجب ان لا تقل عن 6 حروف او ارقام",
      "required_information" : "البيانات المطلوبة",
      "you_need_to_complete_some_required_information" : "هناك بعض البيانات المطلوبة يجب استكمالها",
      "complete_information" : "استكمال البيانات",
      "thanks_for_submitting" : "شكرا علي الإرسال",
      "distance" : "المسافة",
      "destinations" : "أماكن التوصيل",
      "name":"الاسم",
      "students_list":"قائمة الأطفال",
      "gender":"النوع",
      "find_school_transportation":"البحث عن المدارس",
      "choose_from_our_business_providers":"اختر من مزودي الخدمات المشتركين لدينا",
      "choose_from_our_schools_transportation_providers":"اختر من شركات مزودي الخدمات المشتركين لدينا",
      "choose_from_our_corporate_and_employees_transportation_providers":"اختر من المدارس مزودي الخدمات المشتركين لدينا",
      "mobile":"رقم التواصل",
      "type":"النوع",
      "routes":"خطوط السير",
      "routes_list":"خطوط السير",
      "apply_now":"التقدم الان",
      "events_and_news" : "الاحداث و الاخبار",
      "route_locations" : "نقاط التوقف",
      "drivers" : "السائقين",
      "start_date" : "تاريخ البدء",
      "end_date" : "تاريخ الانتهاء",
      "total_cost" : "التكلفة الإجمالية",
      "business_info" : "جهة العمل",
      "active_business" : "جهة العمل الحالية",
      "current_applied_business" : "جهة العمل المشترك بها حاليا",
      "find_transportation" : "البحث عن خدمة",
      "profile" : "الصفحة الشخصية",
      "parent_profile" : "البينات الشخصية",
      "update_info" : "تحديث البيانات",
      "update_your_information" : "تحديث البيانات الشخصية",
      "private_trips" : "الرحلات الخاصة",
      "change_picture" : "تغيير الصورة الشخصية",
      "thanks" : "شكرا لك",
      "canceled" : "تم الغاؤها",
      "complete" : "إكمال",
      "pending_invoice" : "فاتورة غير مدفوعة",
      "address" : "العنوان",
      "country" : "البلد",
      "male" : "ذكر",
      "female" : "انثي",
      "estimated_time_to_start" : "الوقت المتبقي لبدء الرحلة",
      "estimated_time" : "الوقت التقريبي",
      "payment_method" : "طريقة الدفع",
      "business" : "جهة العمل",
      "subtotal" : "التكلفة",
      "discount" : "الخصم",
      "payment_status" : "حالة الدفع",
      "cancel_trip" : "إلغاء الرحلة",
      "paid" : "مدفوعة",
      "unpaid" : "غير مدفوعة",
      "pay_in_cash" : "الدفع نقدا",
      "notification_details" : "تفاصيل الرسالة",
      "sent_applications" : "الطلبات المرسلة",
      "student_applications" : "الطلبات المرسلة",
      "previously_sent_applications" : "الطلبات المرسلة",
      "previously_sent_applications_to_business_providers" : "الطلبات المرسلة للشركات ومقدمي الخدمة",
      "saturday" : "السبت",
      "sunday" : "الاحد",
      "monday" : "الاثنين",
      "tuesday" : "الثلاثاء",
      "wednesday" : "الأربعاء",
      "thursday" : "الخميس",
      "friday" : "الجمعة",
      "date" : "التاريخ",
      "School" : "المدرسة",
      "apply_to_this_business" : "التقديم لهذه الشركة",
      "Payment" : "الدفع",
      "current_route" : "خط السير الحالي",
      "edit_page" : "صفحة التعديل",
      "load_more" : "عرض المزيد",
      "find_by_business_name" : "البحث عن طريق الإسم",
      "business_list" : "قائمة مزودي الخدمة",
      "schools" : "مدارس",
      "school" : "مدرسة",
      "companies" : "شركات",
      "company" : "شركة",
      "start_time" : "وقد البدء",
      "find_address" : "البحث عن عنوان",
      "birthday" : "تاريخ الميلادة",
      "change_information" : "تغيير البيانات",
      "change" : "تغيير",
      "student_name" : "اسم الطالب",
      "from" : "من",
      "to" : "إلى",
      "sent_successfully" : "تم إرسال الطلب بنجاح",
      "no_data_available" : "لا يوجد بيانات اخرى لعرضها",
      "find_schools_providers" : "البحث عن مدارس",
      "find_companies" : "البحث عن شركات",
      "there_is_no_data_yet" : "لم يتم إضافة بيانات بعد",
      "empty" : "لا يوجد بيانات",
      "empty_data" : "لا يوجد بيانات",
      "boy" : "بنت",
      "girl" : "ولد",
      "your_title" : "العنوان الذي تختاره",
      "support" : "الدعم الفني",
      "other" : "أخرى",
      "human_resources" : "الموارد البشرية",
      "normal" : "عادي",
      "high" : "عالي",
      "low" : "ضعيف",
      "need_help" : "رسائل الدعم الفني",
      "enable" : "تفعيل",
      "disable" : "تعطيل",
      "change_notifications" : "تغيير التنبيهات",
      "change_language" : "تغيير اللغة",
      "Send" : "إرسال",
      "wallet" : "المحفظة الالكترونية",
      "balance" : "الرصيد",
      "driver_profile" : "البيانات الشخصية",
      "private_trips_history":"سجل الرحلات الخاصة",
      "title" : "العنوان",
      "companies_looking_for_drivers" : "شركات تبحث عن سائقين",
      "schools_looking_for_drivers" : "مدارس تبحث عن سائقين",
      "new_withdrawal_request" : "طلب سحب جديد",
      "wallet_balance" : "رصيد المحفظة",
      "done" : "انتهى",
      "rejected" : "مرفوض",
      "this_is_the_balance_that_you_have" : "اجمالي الرصيد المتاح في محفظتك",
      "show_details" : "عرض التفاصيل",
      "amount" : "القيمة",
      "create_wallet" : "إنشاء محفظة",
      "added" : "تم الإضافة بنجاح",
      "withdrawal_list" : "طلبات السحب",
      "withdrawal_request" : "طلب سحب جديد",
      "withdraw_request" : "طلب سحب جديد",
      "make_request_to_convert_your_balance_into_cash" : "إنشاء طلب لسحب رصيدك نقدا",
      "payment_methods" : "طرق الدفع",
      "fullname" : "الإسم بالكامل",
      "debit_balance" : "رصيد المدين",
      "your_upcoming_trip" : "رحلتك القادمة",
      "your_current_trip" : "الرحلة الحالية",
      "started" : "بدأت",
      "the_trip" : "الرحلة",
      "trip_payment" : "دفع قيمة الرحلة",
      "you_should_get_this_amount_in_cash" : "يجب ان تحصل على هذا المبلغ نقدا من العميل",
      "collected_cash_list" : "قائمة المبالغ المسحوبة من المديونية",
      "collected_cash" : "المبالغ المسحوبة"
		  } 
		  ');

		$data = [];
		$i=0;
		foreach ($a as $key => $value) 
		{
			$data = ['code'=> str_replace(' ', '_', strtolower($key))];
			$data['translation']['arabic'] = $value;
			$data['translation']['english'] = ucfirst(str_replace('_', ' ', $key));
			$this->repo->storeItems($data);
		}
		return null;

		try 
		{	
		    return render('translations', 
			[
		        'load_vue' => true,
		        'title' => translate('Translations'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'languages' => $this->languageRepo->getActive(),
		    ]);
			
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	public function store() 
	{
		$params = $this->app->request()->get('params');

        try {	
			try {
			
				$params['code'] =  strtolower(str_replace([' ', '/', '&', '?','؟' , '@', '#', '$', '%', '(', ')', '-', '='], '_', $params['translation']['english'])) ;
				$this->validate($params) ;

			} catch (\Throwable $th) {
	        	return array('error'=>$th->getMessage());
			}

        	$params['created_by'] = $this->app->auth()->id;

            $returnData = (!empty($this->repo->storeItems($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>0)
            : array('result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}



	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

            if ($this->repo->updateItems($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>0);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request". $e->getMessage(), 1);
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['translation_id']);


            if ($this->repo->delete($params['translation_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

	public function validate($params) 
	{

		if (isset($this->repo->findByCode($params['code'])->translation_id))
		{
        	throw new \Exception(translate('COUPON_DUPLICATED'), 1);
		}

	}


}