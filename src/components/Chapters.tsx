import React, { Component } from 'react';
import { Table, Divider, Tag, Typography } from 'antd';

const { Title } = Typography;

interface ChapterRow {
  key: string,
  name: string,
  age: number,
  address: string,
  tags?: Array<string>,
}

class Chapters extends Component {
  render() {
    return (
      <div>
        <Title level={2}>Chapters List</Title>
        <Table columns={columns} dataSource={data} />
      </div>
    );
  }
}

export default Chapters;

const columns = [
  {
    title: 'Name',
    dataIndex: 'name',
    key: 'name',
    render: (text:string) => <span>{text}</span>,
  },
  {
    title: 'Age',
    dataIndex: 'age',
    key: 'age',
  },
  {
    title: 'Address',
    dataIndex: 'address',
    key: 'address',
  },
  {
    title: 'Tags',
    key: 'tags',
    dataIndex: 'tags',
    render: (tags:Array<string>) => (
      <span>
        {tags.map((tag:string) => {
          let color = tag.length > 5 ? 'geekblue' : 'green';
          if (tag === 'loser') {
            color = 'volcano';
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
    title: 'Action',
    key: 'action',
    render: (text:string, record:ChapterRow) => (
      <span>
        <span>Invite {record.name}</span>
        <Divider type="vertical" />
        <span>Delete</span>
      </span>
    ),
  },
];

const data:Array<ChapterRow> = [
  {
    key: '1',
    name: 'John Brown',
    age: 32,
    address: 'New York No. 1 Lake Park',
    tags: ['nice', 'developer'],
  },
  {
    key: '2',
    name: 'Jim Green',
    age: 42,
    address: 'London No. 1 Lake Park',
    tags: ['loser'],
  },
  {
    key: '3',
    name: 'Joe Black',
    age: 32,
    address: 'Sidney No. 1 Lake Park',
    tags: ['cool', 'teacher'],
  },
];
