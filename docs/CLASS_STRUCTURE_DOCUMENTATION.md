# Class Structure System Documentation

## Overview

The Class Structure System is a comprehensive Laravel-based solution for managing educational institution hierarchies. It provides a flexible framework for organizing schools by types, class levels, streams, and individual class units where students are enrolled.

## System Architecture

### Hierarchical Structure

```
School Types (Foundation)
    ↓
Class Levels (Grades/Years)
    ↓
Streams (Sections) [Optional]
    ↓
Class Streams (Final Class Units)
```

### Core Components

1. **School Types**: Define education levels (Nursery, Primary, Secondary)
2. **Class Levels**: Specific grades within school types (P1, P2, S1, S2)
3. **Streams**: Optional divisions for parallel classes (A, B, C)
4. **Class Streams**: Final operational units where students are enrolled

## Database Schema

### Tables Overview

| Table | Purpose | Key Relationships |
|-------|---------|------------------|
| `school_types` | Education level categories | → `class_levels` |
| `class_levels` | Grade/year definitions | → `class_streams`, ← `school_types` |
| `streams` | Section/division definitions | → `class_streams` |
| `class_streams` | Final class units | ← `class_levels`, ← `streams` |

### Detailed Schema

#### school_types
```sql
- id (Primary Key)
- name (Unique) - e.g., 'Nursery', 'Primary', 'Secondary - O Level'
- description (Text, Nullable)
- default_classes (JSON, Nullable) - Predefined class templates
- sort_order (Integer, Default: 0)
- is_active (Boolean, Default: true)
- timestamps
```

#### class_levels
```sql
- id (Primary Key)
- name (String) - e.g., 'P1', 'S1', 'Baby'
- school_type_id (Foreign Key → school_types.id)
- sort_order (Integer, Default: 0)
- level_teacher_id (Foreign Key → teachers.id, Nullable)
- is_active (Boolean, Default: true)
- timestamps

Constraints:
- Unique: [name, school_type_id]
- Foreign Keys: school_type_id, level_teacher_id
```

#### streams
```sql
- id (Primary Key)
- name (String) - e.g., 'A', 'B', 'C'
- description (Text, Nullable)
- sort_order (Integer, Default: 0)
- is_active (Boolean, Default: true)
- timestamps
```

#### class_streams
```sql
- id (Primary Key)
- name (String) - Auto-generated: "Class Level + Stream"
- class_level_id (Foreign Key → class_levels.id)
- stream_id (Foreign Key → streams.id, Nullable)
- class_teacher_id (Foreign Key → teachers.id, Nullable)
- is_active (Boolean, Default: true)
- timestamps

Constraints:
- Unique: [class_level_id, stream_id]
- Foreign Keys: class_level_id, stream_id, class_teacher_id
```

## File Structure

### Models

#### app/Models/SchoolType.php
**Purpose**: Manages education level categories
**Key Features**:
- JSON casting for `default_classes`
- Relationships to `ClassLevel`
- Active and ordered scopes
- Code attribute generation

**Key Methods**:
```php
classLevels()           // HasMany relationship
activeClassLevels()     // Active class levels only
scopeActive($query)     // Active school types
scopeOrdered($query)    // Ordered by sort_order
getCodeAttribute()      // Generate code from name
```

#### app/Models/ClassLevel.php
**Purpose**: Represents specific grades within school types
**Key Features**:
- Belongs to SchoolType
- Has many ClassStreams
- Level teacher assignment
- Category backward compatibility

**Key Methods**:
```php
schoolType()            // BelongsTo relationship
classStreams()          // HasMany relationship
levelTeacher()          // BelongsTo Teacher
scopeActive($query)     // Active levels only
scopeOrdered($query)    // Ordered by sort_order
getCategoryAttribute()  // Backward compatibility
```

#### app/Models/Stream.php
**Purpose**: Manages section/division definitions
**Key Features**:
- Reusable across class levels
- Sort ordering
- Active status management

**Key Methods**:
```php
classStreams()          // HasMany relationship
```

#### app/Models/ClassStream.php
**Purpose**: Final operational class units
**Key Features**:
- Combines ClassLevel + Stream
- Student enrollment point
- Subject assignments
- Teacher assignment

**Key Methods**:
```php
classLevel()            // BelongsTo relationship
stream()                // BelongsTo relationship
classTeacher()          // BelongsTo Teacher
students()              // HasMany Students
subjects()              // BelongsToMany with pivot
```

#### app/Models/ClassCategory.php
**Purpose**: Legacy model for backward compatibility
**Note**: Being phased out in favor of SchoolType

### Controllers

#### app/Http/Controllers/ClassController.php
**Purpose**: Main class management operations
**Key Features**:
- CRUD operations for class streams
- Class listing with grouping
- Teacher and student management integration

**Key Methods**:
```php
index()                 // List all classes grouped by school type
create()                // Show create form
store()                 // Create new class stream
show()                  // Display class details
edit()                  // Show edit form
update()                // Update class stream
destroy()               // Delete class stream
setupWizard()           // Show setup wizard
clearAll()              // Clear all class data (testing)
```

#### app/Http/Controllers/ClassSetupWizardController.php
**Purpose**: Automated class structure creation
**Key Features**:
- Predefined templates by school type
- Flexible stream assignments
- Fresh vs Update modes
- Bulk structure creation

**Key Methods**:
```php
index()                     // Show wizard interface
getClassOptions()           // Get predefined class templates
saveClassStructure()        // Process and save structure
getExistingStructure()      // Load current structure for updates
getPreview()                // Preview structure before saving
```

### Migrations

#### 2025_12_19_100300_create_school_types_table.php
Creates the foundation school types table with JSON support for default classes.

#### 2025_12_19_100400_create_class_levels_table.php
Creates class levels with school type relationships and unique constraints.

#### 2025_12_19_100420_create_class_streams_table.php
Creates the final class stream table with all foreign key relationships.

### Views

#### resources/views/modules/classes/
- `index.blade.php` - Main class listing page
- `create.blade.php` - Individual class creation form
- `edit.blade.php` - Class editing form
- `show.blade.php` - Class details view
- `setup-wizard.blade.php` - Automated setup interface
- `setup-prompt.blade.php` - Initial setup prompt

## Setup Wizard Functionality

### Predefined Templates

The system includes predefined class structures for different school types:

```php
'nursery' => ['Baby', 'Middle', 'Top']
'primary' => ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7']
'secondary_o' => ['S1', 'S2', 'S3', 'S4']
'secondary_a' => ['S5', 'S6']
```

### Setup Modes

1. **Fresh Mode**: 
   - Clears all existing class data
   - Creates completely new structure
   - Handles foreign key constraints properly

2. **Update Mode**:
   - Preserves existing data
   - Adds new classes to current structure
   - Prevents duplicates

### Stream Assignment

- Flexible assignment of streams to class levels
- Not all classes need all streams
- Supports mixed configurations (some classes with streams, others without)

## API Endpoints

### Setup Wizard API Routes
```php
GET  /api/classes/setup-wizard/existing-structure
POST /api/classes/setup-wizard/class-options
POST /api/classes/setup-wizard/preview
POST /api/classes/setup-wizard/save
```

### Standard CRUD Routes
```php
GET    /classes                    # List all classes
GET    /classes/create             # Show create form
POST   /classes                    # Store new class
GET    /classes/{class}            # Show class details
GET    /classes/{class}/edit       # Show edit form
PUT    /classes/{class}            # Update class
DELETE /classes/{class}            # Delete class
GET    /classes/setup-wizard       # Show setup wizard
```

## Permissions

All class operations are protected by permission middleware:

- `classes.view` - View class listings
- `classes.create` - Create new classes
- `classes.edit` - Edit existing classes
- `classes.delete` - Delete classes
- `classes.view-detail` - View individual class details

## Usage Examples

### Creating a Complete School Structure

1. **Using Setup Wizard**:
   ```php
   // Select school types: ['primary', 'secondary_o']
   // System creates: P1-P7, S1-S4
   // Add streams: ['A', 'B', 'C']
   // Assign streams to specific classes
   ```

2. **Manual Creation**:
   ```php
   // Create school type
   $schoolType = SchoolType::create(['name' => 'Primary']);
   
   // Create class level
   $classLevel = ClassLevel::create([
       'name' => 'P1',
       'school_type_id' => $schoolType->id
   ]);
   
   // Create stream
   $stream = Stream::create(['name' => 'A']);
   
   // Create final class
   ClassStream::create([
       'name' => 'P1 A',
       'class_level_id' => $classLevel->id,
       'stream_id' => $stream->id
   ]);
   ```

### Querying Class Structure

```php
// Get all classes grouped by school type
$classes = ClassLevel::with(['classStreams.stream', 'schoolType'])
    ->orderBy('school_type_id')
    ->orderBy('sort_order')
    ->get()
    ->groupBy('school_type_id');

// Get students in a specific class
$students = ClassStream::find(1)->students;

// Get subjects for a class
$subjects = ClassStream::find(1)->subjects;
```

## Best Practices

### Data Integrity
- Always use transactions when creating multiple related records
- Validate foreign key relationships before creation
- Handle cascade deletions properly

### Performance
- Use eager loading for relationships
- Index frequently queried columns
- Consider caching for read-heavy operations

### Flexibility
- Design for multiple school types in one system
- Allow optional streams for different organizational needs
- Support both automated and manual class creation

## Troubleshooting

### Common Issues

1. **Foreign Key Constraint Errors**:
   - Ensure parent records exist before creating children
   - Use proper deletion order when clearing data

2. **Duplicate Class Names**:
   - Check unique constraints on class_levels table
   - Validate input before creation

3. **Stream Assignment Issues**:
   - Verify stream exists before assignment
   - Handle null stream_id for classes without streams

### Debugging Tips

- Check migration order and foreign key constraints
- Verify model relationships are properly defined
- Use Laravel's query log to debug complex queries
- Test with small datasets before bulk operations

## Future Enhancements

### Planned Features
- Academic year support
- Class capacity management
- Automated class promotion
- Integration with timetabling system
- Reporting and analytics

### Extensibility Points
- Custom school type definitions
- Flexible naming conventions
- Integration hooks for external systems
- Advanced permission granularity

---

*This documentation covers the complete class structure system as implemented in the Laravel application. For specific implementation details, refer to the individual model and controller files.*