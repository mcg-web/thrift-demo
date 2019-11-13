namespace php Inbox
namespace go  inbox
namespace js  inbox

typedef i32 int
typedef i64 bigInt

enum MessageStatus {
    DELETED = 0
    OPEN    = 1
    CLOSE   = 2
}

struct Inbox {
    1: int            id,
    2: list<Message>  messages,
    3: string         name,
}

struct Message {
    1: int           id,
    2: string        subject,
    4: string        content,
    5: MessageStatus status,
}

// exception
exception NotFoundException {
    1: string message
    2: int code,
}

// service
service InboxService {
    bool  createInbox(1: Inbox inbox);
    Inbox getInbox(1: int inboxID) throws (1: NotFoundException e);
    bool  addMessage(1: int inboxID, 2: Message message) throws (1: NotFoundException e);
    oneway void openMessage(1: Message message);
    bool deleteMessage(1: Message message) throws (1: NotFoundException e);
}
