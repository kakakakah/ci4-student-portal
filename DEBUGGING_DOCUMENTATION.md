# Week 14 – Debugging Documentation
**Course:** Advanced Web Development – CodeIgniter 4
**Module:** Unit Testing & Debugging

---

## 1. Using dd() to Inspect a Model Object

### What is dd()?
`dd()` stands for **Dump and Die**. It is a CI4 helper function that
immediately stops the execution of the application and displays the full
contents of any variable in a readable format. It is used during
development to inspect objects, arrays, and request data without needing
a separate debugger tool.

### How We Used It
In `app/Controllers/Students.php`, we added `dd($this->model)` at the
top of the `index()` method to inspect the StudentModel object:

```php
public function index(): string
{
    dd($this->model);   // Dump the model object and stop execution

    $search = trim((string) $this->request->getGet('search'));
    // ...
}
```

When we visited `http://localhost:8080/students` with this line active,
the page stopped loading and displayed the full model object dump,
showing all its internal properties.

### What the dd() Output Showed
The dump revealed the following important properties of the StudentModel:

```
App\Models\StudentModel Object
(
    [table]            => students
    [primaryKey]       => id
    [allowedFields]    => Array ( [0] => name [1] => email [2] => bio )
    [useTimestamps]    => true
    [validationRules]  => Array (
        [name]  => required|min_length[2]|max_length[100]
        [email] => required|valid_email|max_length[100]|is_unique[students.email]
        [bio]   => permit_empty|max_length[500]
    )
)
```

### Bug Found Using dd()
By inspecting the output we noticed that `photo` was **missing** from the
`$allowedFields` array. This meant that even after a successful file
upload, the photo filename could never be saved to the database because
CI4's model silently ignores fields that are not in `$allowedFields`.

---

## 2. Stack Trace Analysis

### What is a Stack Trace?
A stack trace is an error report that shows the exact sequence of
function calls that led to an error. It lists each step from the most
recent (top) to the original trigger (bottom), along with the file name
and line number of each call.

### The Error We Encountered
When we first copied our controllers into the project, the following
error appeared:

```
ErrorException
include(C:\Users\pc\webdev-finals\vendor\composer\../../../app/Controllers/BaseController.php):
Failed to open stream: No such file or directory
```

### Stack Trace Breakdown

```
VENDORPATH\composer\ClassLoader.php : 576
    → CodeIgniter\Debug\Exceptions->errorHandler()

VENDORPATH\composer\ClassLoader.php : 427
    → include()

APPPATH\Controllers\Home.php : 7
    → Composer\Autoload\ClassLoader->loadClass()
```

| Line | What It Means |
|------|--------------|
| `ClassLoader.php:576` | PHP's autoloader tried to load a class file |
| `ClassLoader.php:427` | It called `include()` to load the file |
| `Home.php:7` | The trigger — `Home.php` declared `use App\Controllers\BaseController` but the file did not exist |

### Reading the Stack Trace
The stack trace is read **from bottom to top** to find the root cause:
1. `Home.php line 7` — this is where the error originated. Our controller
   declared it needed `BaseController` via the `use` statement.
2. The autoloader tried to find and load `BaseController.php`.
3. The file did not exist, so PHP threw a fatal `ErrorException`.

---

## 3. Bug Fix Documentation

### Bug 1 — Missing BaseController.php

**What was wrong:**
`app/Controllers/BaseController.php` did not exist in the project. All
four controllers (`Home`, `Auth`, `Students`, `Upload`) extended
`BaseController`, so the entire application crashed on every page load.

**How we found it:**
The stack trace shown above pointed directly to `Home.php line 7` where
`use App\Controllers\BaseController` was declared. Since the autoloader
could not find the file, it threw a fatal error.

**How we fixed it:**
We created `app/Controllers/BaseController.php` with the standard CI4
`BaseController` contents:

```php
<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
    protected $request;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
    }
}
```

After creating this file, all pages loaded correctly.

---

### Bug 2 — 'photo' Missing from $allowedFields

**What was wrong:**
After a student successfully uploaded a profile photo, the filename was
never saved to the `students` database table. The upload itself worked,
but querying the student record always returned `null` for the `photo`
column.

**How we found it:**
Using `dd($this->model)` in `Students.php`, we inspected the
`$allowedFields` array and found it only contained:
```
['name', 'email', 'bio']
```
The field `photo` was missing. CI4 models silently ignore any fields not
listed in `$allowedFields` during insert/update operations.

**How we fixed it:**
We added `'photo'` to the `$allowedFields` array in `StudentModel.php`:

```php
// Before (broken):
protected $allowedFields = ['name', 'email', 'bio'];

// After (fixed):
protected $allowedFields = ['name', 'email', 'bio', 'photo'];
```

After this fix, uploaded photo filenames were correctly saved to the
database and displayed on student profiles.
