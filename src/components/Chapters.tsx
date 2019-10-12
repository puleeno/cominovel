import { Button, Divider, Icon, PageHeader, Table, Tag } from "antd";
import React, { Component } from "react";

interface ChapterRow {
  key: string;
  name: string;
  age: number;
  address: string;
  tags?: string[];
}

class Chapters extends Component {
  public render() {
    return (
      <div>
        <PageHeader
          title="Chapters"
          subTitle="Danh sách các chapter hiện tại đang có"
          extra={[
            <Button>
              <Icon type="plus" />
              New Chapter
            </Button>
          ]}
        />
        <Table columns={columns} dataSource={data} />
      </div>
    );
  }
}

export default Chapters;

const columns = [
  {
    title: "Name",
    dataIndex: "name",
    key: "name",
    render: (text: string) => <span>{text}</span>,
  },
  {
    title: "Age",
    dataIndex: "age",
    key: "age",
  },
  {
    title: "Address",
    dataIndex: "address",
    key: "address",
  },
  {
    title: "Tags",
    key: "tags",
    dataIndex: "tags",
    render: (tags: string[]) => (
      <span>
        {tags.map((tag: string) => {
          let color = tag.length > 5 ? "geekblue" : "green";
          if (tag === "loser") {
            color = "volcano";
          }
          return (
            <Tag color={color} key={tag}>
              {tag.toUpperCase()}
            </Tag>
          );
        })}
      </span>
    ),
  },
  {
    title: "Action",
    key: "action",
    render: (text: string, record: ChapterRow) => (
      <span>
        <span>Invite {record.name}</span>
        <Divider type="vertical" />
        <span>Delete</span>
      </span>
    ),
  },
];

const data: ChapterRow[] = [
  {
    key: "1",
    name: "John Brown",
    age: 32,
    address: "New York No. 1 Lake Park",
    tags: ["nice", "developer"],
  },
  {
    key: "2",
    name: "Jim Green",
    age: 42,
    address: "London No. 1 Lake Park",
    tags: ["loser"],
  },
  {
    key: "3",
    name: "Joe Black",
    age: 32,
    address: "Sidney No. 1 Lake Park",
    tags: ["cool", "teacher"],
  },
];
