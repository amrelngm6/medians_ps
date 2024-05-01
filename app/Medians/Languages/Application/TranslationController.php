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
			"trip duration": "مدة الرحلة",
			"trip number": "رقم الرحلة",
			"trip status": "حالة الرحلة",
			"completed": "إنتهت",
			"pickups": "نقاط التوقف",
			"license number": "رقم الرخصة",
			"contact number": "رقم التواصل",
			"you have no route yet": "ليس لديك أى خطوط سير مرتبطة بحسابك",
			"no data here": "لا يوجد بيانات",
			"no data available": "لا يوجد بيانات متاحة حاليا",
			"back": "عودة",
			"no pickup locations at this trip": "لا يوجد نقاط توقف في هذه الرحلة",
			"no pickup locations at this route": "لا يوجد نقاط توقف في خط السير",
			"no pickup locations here": "لا يوجد نقاط توقف هنا",
			"your help messages": "رسائل المساعدة التي ارسلتها",
			"ticket number": "رقم المتابعة",
			"department": "القسم",
			"status": "الحالة",
			"priority": "الأولوية",
			"time": "الوقت",
			"support comments": "تعليقات الدعم الفني",
			"comment": "التعليق",
			"view ticket": "عرض الرسالة",
			"notifications list": "قائمة التنبيهات",
			"list of your notifications": "قائمة لأحدث التنبيهات و الإشعارات الخاصة بك",
			"your old sent messages list": "الرسائل المرسلة",
			"click here to view your previous sent messages": "قائمة بالرسائل التي تم إرسالها من قبل",
			"new": "جديدة",
			"all": "الجميع",
			"logout": "تسجيل الخروج",
			"closed": "مغلقة",
			"app preferences": "إعدادات التطبيق",
			"get permission": "عرض الصلاحيات",
			"get permissions": "عرض الصلاحيات",
			"dark mode": "النظام الليلي",
			"show template in darkmode": "عرض التصميم بألوان داكنة",
			"next": "التالي",
			"set your custom configuration": "قم بضبط إعداداتك الخاصة",
			"start now": "إبدأ الان",
			"start with your account": "إبدأ الان بحسابك الشخصي",
			"some permissions are required to use the app": "بعض الصلاحيات مطلوبة لإستخدام التطبيق",
			"create your account": "انشيْ حسابك الان",
			"forgot password": "نسيت كلمة المرور ؟",
			"confirm": "تأكيد",
			"view": "عرض",
			"updated": "تم التحديث",
			"updated successfully": "تم التحديث بنجاح",
			"available routes": "خطوط السير المتاحة",
			"list of your added children": "قائمة بالأطفال الذين تم إضافتهم",
			"view details": "عرض التفاصيل",
			"add student": "إضافة طالب",
			"add new student now": "إضافة طالب جديد الان",
			"start now with filling new student information": "إبدأ الان باضافة بيانات الطالب وسيتم المراجعة والرد عليك بأقرب وقت",
			"student info updated": "سيتم مراجعة البيانات و سيتم التواصل معك في أقرب وقت",
			"forgot password message": "سيتم إرسال رقم التأكيد علي البريد الإلكتروني",
			"scheduled": "تم الاعداد",
			"trips": "الرحلات",
			"working days": "أيام الدراسة",
			"week days that you need to pickup": "أيام الأسبوع التي يتم الالتقاء فيها",
			"vacations": "الأجازات",
			"vacations days subtitle": "أيام الأجازات او الغياب",
			"pickup and destinations": "أماكن اللقاء و التوصيل",
			"locations": "المواقع",
			"save": "حفظ",
			"go home": "الذهاب للرئيسية",
			"approved": "مفعل",
			"pending": "تحت المراجعة",
			"change password": "تغيير كلمة المرور",
			"current password": "كلمة المرور الحالية",
			"new password": "كلمة المرور الجديدة",
			"confirm password": "تأكيد كلمة المرور",
			"change password message": "يمكنك تغيير كلمة المرور من هنا, ويجب ان لا تقل عن 6 حروف او ارقام",
			"required information": "البيانات المطلوبة",
			"you need to complete some required information": "هناك بعض البيانات المطلوبة يجب استكمالها",
			"complete information": "استكمال البيانات",
			"thanks for submitting": "شكرا علي الإرسال",
			"distance": "المسافة",
			"destinations": "أماكن التوصيل",
			"name": "الاسم",
			"students list": "قائمة الأطفال",
			"gender": "النوع",
			"find school transportation": "البحث عن المدارس",
			"choose from our business providers": "اختر من مزودي الخدمات المشتركين لدينا",
			"choose from our schools transportation providers": "اختر من شركات مزودي الخدمات المشتركين لدينا",
			"choose from our corporate and employees transportation providers": "اختر من المدارس مزودي الخدمات المشتركين لدينا",
			"mobile": "رقم التواصل",
			"type": "النوع",
			"routes": "خطوط السير",
			"routes list": "خطوط السير",
			"apply now": "التقدم الان",
			"events and news": "الاحداث و الاخبار",
			"route locations": "نقاط التوقف",
			"drivers": "السائقين",
			"start date": "تاريخ البدء",
			"end date": "تاريخ الانتهاء",
			"subscription type": "نوع الإشتراك",
			"total cost": "التكلفة الإجمالية",
			"business info": "جهة العمل",
			"active business": "جهة العمل الحالية",
			"current applied business": "جهة العمل المشترك بها حاليا",
			"find transportation": "البحث عن خدمة",
			"profile": "الصفحة الشخصية",
			"parent profile": "البينات الشخصية",
			"update info": "تحديث البيانات",
			"update your information": "تحديث البيانات الشخصية",
			"private trips": "الرحلات الخاصة",
			"change picture": "تغيير الصورة الشخصية",
			"thanks": "شكرا لك",
			"canceled": "تم الغاؤها",
			"complete": "إكمال",
			"pending invoice": "فاتورة غير مدفوعة",
			"address": "العنوان",
			"country": "البلد",
			"male": "ذكر",
			"female": "انثي",
			"estimated time to start": "الوقت المتبقي لبدء الرحلة",
			"estimated time": "الوقت المتبقي",
			"payment method": "طريقة الدفع",
			"business": "جهة العمل",
			"subtotal": "التكلفة",
			"discount": "الخصم",
			"payment status": "حالة الدفع",
			"cancel trip": "إلغاء الرحلة",
			"paid": "مدفوعة",
			"unpaid": "غير مدفوعة",
			"pay in cash": "الدفع نقدا",
			"notification details": "تفاصيل الرسالة",
			"active subscription": "الاشتراك الحالي",
			"sent applications": "الطلبات المرسلة",
			"student applications": "الطلبات المرسلة",
			"previously sent applications": "الطلبات المرسلة",
			"previously sent applications to business providers": "الطلبات المرسلة للشركات ومقدمي الخدمة",
			"update student": "تحديث بيانات الطالب",
			"School": "المدرسة",
			"apply to this business": "التقديم لهذه الشركة",
			"payment": "الدفع",
			"current route": "خط السير الحالي",
			"currently subscribed business": "جهة العمل المشترك بها حاليا",
			"student location": "مكان الطالب",
			"define the pickup destination for the student": "يجب تحديد مواقع الالتقاء و التوصيل للطالب",
			"saturday": "السبت",
			"sunday": "الاحد",
			"monday": "الاثنين",
			"tuesday": "الثلاثاء",
			"wednesday": "الأربعاء",
			"thursday": "الخميس",
			"friday": "الجمعة",
			"date": "التاريخ",
			"add new vacation": "اجازة جديدة",
			"previously sent vacations for the student": "أيام الإجازات التي تم تحديدها للطالب",
			"update vacation": "تحديث الإجازة",
			"vacations list": "ثائمة الإجازات",
			"edit page": "صفحة التعديل",
			"load more": "عرض المزيد",
			"find by business name": "البحث عن طريق الإسم",
			"business list": "قائمة مزودي الخدمة",
			"schools": "مدارس",
			"school": "مدرسة",
			"companies": "شركات",
			"company": "شركة",
			"need private trip": "تحتاج رحلة خاصة",
			"apply for students": "الاشتراك لطالب",
			"start time": "وقد البدء",
			"set destination": "تحديد مكان الوصول",
			"send trip request": "إرسال طلب الرحلة",
			"find address": "البحث عن عنوان",
			"birthday": "تاريخ الميلادة",
			"change information": "تغيير البيانات",
			"change": "تغيير",
			"your students are safe": "أبنائك بأمان معنا",
			"fill this information and we will contact you once we review it": "يرجى إدخال بيانات الطالب وسيتم التواصل معاك مباشرة بمجرد مراجعة البينات",
			"add student name first": "يجب إدخال اسم الطالب أولا",
			"add locations first": "يجب تحديد المواقع أولا",
			"student name": "اسم الطالب",
			"from": "من",
			"to": "إلى",
			"sent successfully": "تم إرسال الطلب بنجاح",
			"no more data available": "لا يوجد بيانات اخرى لعرضها",
			"find schools providers": "البحث عن مدارس",
			"find companies": "البحث عن شركات",
			"there is no subscription yet": "لا يوجد إشتراكات لهذا الطالب بعد",
			"there is no data yet": "لم يتم إضافة بيانات بعد",
			"empty": "لا يوجد بيانات",
			"empty data": "لا يوجد بيانات",
			"boy": "بنت",
			"girl": "ولد",
			"choose student": "أختر الطالب",
			"choose one from your added students": "إختر من الطلاب الذين تم إضافتهم",
			"select student first": "اختر الطالب اولا",
			"choose package": "أختر الباقة",
			"choose one from business packages": "إختر من الباقات المتاحة ",
			"subscription details": "بيانات الإشتراك",
			"select package first": "قم بتحديد الباقة",
			"your title": "العنوان الذي تختاره",
			"support": "الدعم الفني",
			"other": "أخرى",
			"human resources": "الموارد البشرية",
			"normal": "عادي",
			"high": "عالي",
			"low": "ضعيف",
			"need help": "رسائل الدعم الفني",
			"enable": "تفعيل",
			"disable": "تعطيل",
			"change notifications": "تغيير التنبيهات",
			"change language": "تغيير اللغة",
			"month": "شهر",
			"monthly": "شهريا",
			"yearly": "سنويا",
			"year": "عام كامل",
			"quarterly": "فصل دراسي",
			"quarter": "فصل دراسي",
			"send": "إرسال",
			"show details": "عرض التفاصيل",
			"rejected": "مرفوض",
			"this request has been rejected so you can choose another provider": "هذا الطلب تم رفضه يمكنك اختيار شركة اخرى",
			"this request has not been approved yet by the business": "هذا الطلب لم يتم الموافقة عليه بعد",
			"request status": "حالة الطلب",
			"private trips history": "سجل الرحلات الخاصة",
			"active route": "خط السير الحالي",
			"currently assigned route": "خط السير الذي تم تحديده",
			"trip is already paid": "الرحلة مدفوعة بالفعل ولا يمكن إلغاؤها"
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