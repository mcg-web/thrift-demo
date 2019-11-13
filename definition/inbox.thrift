namespace php ThriftModel.Inbox
namespace go inbox
namespace js inbox

enum MessageStatus
{
    DELETED = 0
    OPEN    = 1
    CLOSE   = 2
}

struct Inbox
{
    1: i32            id,
    2: list<Message>  messages,
    3: User           user,
}

struct Message
{
    1: i64           id,
    2: string        subject,
    3: string        name,
    4: string        content,
    5: MessageStatus status,
}

struct User
{
    1: i64    id,
    2: string firstName
    3: string lastName
}

service InboxService
{
    bool addMessage(2: Message message);
    oneway void openMessage(1: Message message);
    bool deleteMessage(1: Message message);
}
