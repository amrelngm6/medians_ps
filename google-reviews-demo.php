<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Reviews Widget Demo - مستشفى بداية</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f7fa;
            
        }
        
        .demo-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .demo-header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        
        .demo-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
        }
        
        .demo-content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .integration-info {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .integration-info h2 {
            color: #333;
            margin-top: 0;
        }
        
        .code-block {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            overflow-x: auto;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .feature-list li:before {
            content: "✓";
            color: #28a745;
            font-weight: bold;
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="demo-header">
        <h1>Google Reviews Widget</h1>
        <p>مكون عرض مراجعات جوجل للمواقع الطبية - تصميم احترافي وسهل التكامل</p>
    </div>
    
    <div class="demo-content">
        <div class="integration-info">
            <h2>طرق التكامل مع موقعك</h2>
            
            <h3>1. التكامل مع PHP (الطريقة المفضلة)</h3>
            <div class="code-block">
&lt;?php include 'google-reviews-widget.php'; ?&gt;
            </div>
            
            <h3>2. التكامل مع HTML</h3>
            <div class="code-block">
&lt;!-- إضافة Font Awesome في head --&gt;
&lt;link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"&gt;

&lt;!-- إضافة المكون في المكان المطلوب --&gt;
&lt;?php include 'google-reviews-integration.html'; ?&gt;
            </div>
            
            <h3>المميزات المتوفرة:</h3>
            <ul class="feature-list">
                <li>تصميم متجاوب يعمل على جميع الأجهزة</li>
                <li>دعم اللغة العربية واتجاه RTL</li>
                <li>عرض تلقائي للشرائح كل 5 ثوانٍ</li>
                <li>دعم التمرير باللمس على الأجهزة المحمولة</li>
                <li>إمكانية التنقل بالأسهم والمؤشرات</li>
                <li>تأثيرات انتقال سلسة وحديثة</li>
                <li>سهولة التخصيص والتطوير</li>
                <li>كود نظيف ومُحسَّن للأداء</li>
            </ul>
            
            <h3>التخصيص:</h3>
            <p>يمكنك تعديل الألوان والأحجام والمحتوى من خلال:</p>
            <ul>
                <li>تعديل متغيرات CSS في بداية ملف الأنماط</li>
                <li>تغيير بيانات المراجعات في ملف PHP</li>
                <li>إضافة المزيد من المراجعات بسهولة</li>
                <li>ربط زر "كتابة مراجعة" بصفحة جوجل الخاصة بك</li>
            </ul>
        </div>
        
        <!-- عرض المكون -->
        <?php include 'google-reviews-widget.php'; ?>
        
        <div class="integration-info">
            <h2>ملاحظات مهمة:</h2>
            <ul>
                <li>تأكد من وجود Font Awesome في موقعك</li>
                <li>استبدل "YOUR_GOOGLE_BUSINESS_ID" برقم هويتك على جوجل</li>
                <li>يمكنك ربط المكون بـ Google Places API لجلب المراجعات تلقائياً</li>
                <li>المكون مُحسَّن لمحركات البحث ويدعم Schema.org</li>
            </ul>
        </div>
    </div>
</body>
</html>
