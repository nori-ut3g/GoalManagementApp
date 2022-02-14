### 権限
なし

### エンドポイント
```
GET https://goal-management.com/api/register
```
パス	必須	id	金融機関の id

### パラメータ
| 場所  | 名称     | 内容 |
|-----|--------|--|
| パス  | `shared_objective_id` | shared_objective_id |

### 応答
| 名称     | 内容 |
|--------|--|
| `objective[id]` | ログアウトしました |
| `objective[user_id]` | ログアウトしました |
| `objective[start_date]` | ログアウトしました |
| `objective[due_date]` | ログアウトしました |
| `objective[status]` | ログアウトしました |
| `objective[finish_date]` | ログアウトしました |
| `objective[update_at]` | ログアウトしました |
| `objective[create_at]` | ログアウトしました |

```js
{
    objective:{
        id:1,
        user_id:1,
        start_date:,
        due_date:,
        status:,
        finish_date:,
        update_at:,
        create_at:,
        
    }
}
```
### Error
            $table->id();
            $table->foreignId('user_id');
            $table->string('title', 50);
            $table->timestamp('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('status')->default(0);
            $table->date('finish_date')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
