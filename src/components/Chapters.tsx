import { Button, Icon, PageHeader, Table, Upload } from "antd";
import React, { Component } from "react";

interface ChapterRow {
}

interface IProps {
}

interface IState {
  isUploading: boolean;
}

class Chapters extends Component<IProps, IState> {

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
            </Button>,
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
    dataIndex: "no",
    editable: true,
    render: (text: string) => <span>{text}</span>,
    title: "No.",
  },
  {
    dataIndex: "thumbnail",
    render: (imageUrl: string) => {
      const uploadButton = (
        <div>
          <Icon type="plus" />
          <div className="ant-upload-text">Upload</div>
        </div>
      );
      return (
        <Upload
          name="avatar"
          listType="picture-card"
          className="avatar-uploader"
          showUploadList={false}
          action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
        >
          { uploadButton }
        </Upload>
      );
    },
    title: "Thumbnail",
    },
  {
    dataIndex: "name",
    editable: true,
    title: "Name",
  },
  {
    dataIndex: "season",
    render: () => (
      <span>Vol 1</span>
    ),
    title: "Season",
  },
  {
    dataIndex: "createdAt",
    title: "Created At",
  },
  {
    render: (text: string, record: ChapterRow) => (
      <div>
        <a href="/wp-admin/post.php?post=14290&action=edit">
          <Button icon="edit" style={{marginRight: 10}} />
        </a>
        <Button type="danger" icon="delete" />
      </div>
    ),
    title: "Action",
  },
];

const data: ChapterRow[] = [
  {
    author: "Puleeno Nguyen",
    createdAt: "2019-09-09 10:00",
    name: "John Brown",
    no: 1,
    season: "Season 1",
    thumbnail: "",
  },
  {
    author: "Puleeno Nguyen",
    createdAt: "2019-09-09 10:00",
    name: "Jim Green",
    no: 2,
    season: "Season 2",
    thumbnail: "",
  },
  {
    author: "Puleeno Nguyen",
    createdAt: "2019-09-09 10:00",
    name: "Joe Black",
    no: 3,
    season: "Season 3",
    thumbnail: "",
  },
];
